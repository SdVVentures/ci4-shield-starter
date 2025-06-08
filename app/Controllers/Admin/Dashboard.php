<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;

class Dashboard extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Check if user is logged in and is admin
        if (!auth()->loggedIn() || !auth()->user()->inGroup('admin')) {
            return redirect()->to('/')->with('error', 'You do not have permission to access that page.');
        }

        // Get user stats
        $totalUsers = count($this->userModel->findAll());
        $activeUsers = count($this->userModel->where('active', 1)->findAll());
        $inactiveUsers = $totalUsers - $activeUsers;

        return view('pages/admin/dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers
        ]);
    }
}
