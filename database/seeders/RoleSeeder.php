<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'supper-admin'],
            ['name' => 'user'],
            ['name' => 'editor'],
        ];

        foreach($roles as $role){
            Role::query()->create($role);
        }
    }
}
