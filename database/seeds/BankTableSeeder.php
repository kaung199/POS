<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'investment' => 0,
            'date' => date('Y-m-d'),
            'min' => 0,
            'cost' => 0,
        ]);
    }
}
