<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Get the User Provider
        $users = new UserModel();

        // Get admin details from .env
        $email = getenv('app.adminEmail') ?: 'admin@example.com';
        $username = getenv('app.adminUsername') ?: 'admin';
        $password = getenv('app.adminPassword') ?: 'Admin123!';

        // Check if admin user already exists
        $existingUser = $users->where('username', $username)->first();
        
        if ($existingUser) {
            // Skip if admin already exists
            echo "Admin user already exists. Skipping creation.\n";
            return;
        }

        // Create the admin user
        $user = new User([
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'active'   => 1,
        ]);

        // Save the user
        $users->save($user);

        // Add to admin group
        $user->addGroup('admin');

        // Add to user group
        $user->addGroup('user');

        // Activate the user
        $user->activate();

        echo "Admin user created successfully.\n";
    }
}
