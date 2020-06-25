<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class MainBoxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'mainBox-list',
            'mainBox-create',
            'mainBox-edit',
            'mainBox-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
