<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PurchaseTableSeeder::class);
        $this->call(MainBoxTableSeeder::class);
        $this->call(PawnTableSeeder::class);
        $this->call(BankTableSeeder::class);
    }
}
