<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PawnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'pawn-index',
            'pawn-report',
            'pawn-yawe-report',
            'pawn-costs',
            'pawn-investment',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
