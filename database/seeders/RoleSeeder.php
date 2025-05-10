<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'superadmin', 'description' => 'Süper admin']);
        Role::create(['name' => 'student', 'description' => 'Öğrenci']);
    }
}
