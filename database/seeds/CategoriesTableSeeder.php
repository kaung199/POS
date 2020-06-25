<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
