<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Settings extends BaseController
{
    public function index()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        return view('pages/admin/settings', [
            'title' => 'Admin Settings'
        ]);
    }
    
    public function update()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }
        
        // Validate input
        $rules = [
            'site_name' => 'required|min_length[3]|max_length[255]',
            'site_description' => 'required',
            'admin_email' => 'required|valid_email',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }
        
        // In a real application, you would save these settings to a database or config file
        // For this example, we'll just redirect with a success message
        
        return redirect()->to('admin/settings')->with('message', 'Settings updated successfully.');
    }
}
