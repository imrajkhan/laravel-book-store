<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
{
    $adminUser = User::where('email', 'admin@example.com')->first();

    if (!$adminUser) {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);
    } else {
        $adminUser->update(['is_admin' => true]);
    }
}

}
