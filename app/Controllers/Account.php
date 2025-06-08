<?php

namespace App\Controllers;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class Account extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function settings()
    {
        // Check if user is logged in
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('error', 'You must be logged in to access this page.');
        }

        return view('pages/account/settings', [
            'user' => auth()->user()
        ]);
    }

    public function updateProfile()
    {
        // Check if user is logged in
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('error', 'You must be logged in to access this page.');
        }

        // Validate input
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|alpha_numeric_space',
            'email' => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Get current user
        $user = auth()->user();
        
        // Update user
        $user->fill([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ]);

        $this->userModel->save($user);

        return redirect()->to('account/settings')->with('message', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        // Check if user is logged in
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('error', 'You must be logged in to access this page.');
        }

        // Validate input
        $rules = [
            'current_password' => 'required',
            'password' => 'required|strong_password',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Get current user
        $user = auth()->user();
        
        // Check current password
        if (!auth()->check($this->request->getPost('current_password'))) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update password
        $user->fill([
            'password' => $this->request->getPost('password'),
        ]);

        $this->userModel->save($user);

        return redirect()->to('account/settings')->with('message', 'Password changed successfully.');
    }
}
