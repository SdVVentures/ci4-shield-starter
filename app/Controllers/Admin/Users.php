<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Models\GroupModel;

class Users extends BaseController
{
    protected $userModel;
    protected $groupModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
    }

    public function index()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Get all users
        $users = $this->userModel->findAll();

        return view('pages/admin/users/index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Get unique groups from the auth_groups_users table
        $db = \Config\Database::connect();
        $groups = $db->table('auth_groups_users')
            ->select('`group`')
            ->distinct()
            ->get()
            ->getResultArray();

        return view('pages/admin/users/create', [
            'groups' => $groups
        ]);
    }

    public function store()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Validate input
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|alpha_numeric_space|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|strong_password',
            'password_confirm' => 'required|matches[password]',
            'groups' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Create user
        $user = new User([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // Save user
        $this->userModel->save($user);

        // Add user to groups
        $groups = $this->request->getPost('groups');
        foreach ($groups as $group) {
            $user->addGroup($group);
        }

        return redirect()->to('admin/users')->with('message', 'User created successfully.');
    }

    public function edit($id = null)
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Get user
        $user = $this->userModel->find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Get unique groups from the auth_groups_users table
        $db = \Config\Database::connect();
        $groups = $db->table('auth_groups_users')
            ->select('`group`')
            ->distinct()
            ->get()
            ->getResultArray();

        // Get user groups
        $userGroups = $user->getGroups();

        return view('pages/admin/users/edit', [
            'user' => $user,
            'groups' => $groups,
            'userGroups' => $userGroups
        ]);
    }

    public function update($id = null)
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Get user
        $user = $this->userModel->find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Validate input
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|alpha_numeric_space',
            'email' => 'required|valid_email',
            'groups' => 'required',
        ];

        // Add password validation if password is provided
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|strong_password';
            $rules['password_confirm'] = 'required|matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Update user
        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        // Add password if provided
        if ($this->request->getPost('password')) {
            $userData['password'] = $this->request->getPost('password');
        }

        $user->fill($userData);

        // Save user
        $this->userModel->save($user);

        // Update user groups
        // First remove all existing groups
        foreach ($user->getGroups() as $group) {
            $user->removeGroup($group);
        }
        
        // Then add the selected groups
        $groups = $this->request->getPost('groups');
        if (is_array($groups)) {
            foreach ($groups as $group) {
                $user->addGroup($group);
            }
        }

        return redirect()->to('admin/users')->with('message', 'User updated successfully.');
    }

    public function delete($id = null)
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Get user
        $user = $this->userModel->find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Check if user is current user
        if ($user->id === auth()->id()) {
            return redirect()->to('admin/users')->with('error', 'You cannot delete your own account.');
        }

        // Delete user
        $this->userModel->delete($id);

        return redirect()->to('admin/users')->with('message', 'User deleted successfully.');
    }
}
