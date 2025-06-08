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

        // Get admin details from .env or fallback values
        $email    = getenv('app.adminEmail') ?: 'admin@example.com';
        $username = getenv('app.adminUsername') ?: 'admin';
        $password = getenv('app.adminPassword') ?: 'Admin123!';

        // Check if admin user already exists
        $existingUser = $users->where('username', $username)->first();

        if ($existingUser) {
            echo "Admin user already exists. Skipping creation.\n";
            return;
        }

        // Create the admin user entity
        $user = new User([
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'active'   => 1,
        ]);

        // Save the user and get the inserted ID
        if (!$users->save($user)) {
            echo "Failed to create admin user.\n";
            print_r($users->errors());
            return;
        }

        // Retrieve the user back from DB to ensure ID is set
        $savedUser = $users->find($users->getInsertID());

        if (!$savedUser) {
            echo "Failed to retrieve newly created admin user.\n";
            return;
        }

        // Assign groups
        $savedUser->addGroup('admin');
        $savedUser->addGroup('user');

        // (Optional) Activate the user (usually redundant if 'active' is set)
        $savedUser->activate();

        echo "Admin user created successfully.\n";
    }
}
