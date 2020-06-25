<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Family@123')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $p_user = User::create([
            'name' => 'Pawn Admin',
            'email' => 'pawn@gmail.com',
            'password' => bcrypt('Pawn@123')
        ]);

        // $p_role = Role::create(['name' => 'Pawn Admin']);
        // $p_permissions = Permission::pluck('id','id')->all();
        // $p_role->syncPermissions($p_permissions);
        // $p_user->assignRole([$p_role->id]);
    }
}
