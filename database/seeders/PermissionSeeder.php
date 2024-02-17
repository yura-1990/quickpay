<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Browse Users'],
            ['name' => 'Read Users'  ],
            ['name' => 'Add Users'   ],
            ['name' => 'Update Users'],
            ['name' => 'Delete Users'],

            ['name' => 'Browse Roles'],
            ['name' => 'Read Roles'  ],
            ['name' => 'Add Roles'   ],
            ['name' => 'Update Roles'],
            ['name' => 'Delete Roles'],

            ['name' => 'Browse Permissions'],
            ['name' => 'Read Permissions'  ],
            ['name' => 'Add Permissions'   ],
            ['name' => 'Update Permissions'],
            ['name' => 'Delete Permissions'],
        ];

        foreach ($permissions as $permission) {
            Permission::query()->create($permission);
        }
    }
}
