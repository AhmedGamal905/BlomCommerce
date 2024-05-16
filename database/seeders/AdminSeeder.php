<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin@admin.com',
        ]);
    }
}
