<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'SuperAdmin',
            'email' => 'rohitverma77270@gmail.com',
            'password' => Hash::make('1234'),
            'is_Admin' => 1,
        ]);
    }
}
