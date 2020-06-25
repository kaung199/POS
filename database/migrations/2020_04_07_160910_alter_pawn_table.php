<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPawnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pawn', function (Blueprint $table) {
            $table->string('auto_voucher')->nullable();
            $table->integer('quantity');
            $table->string('weight')->nullable();
            $table->string('stone_weight')->nullable();
            $table->integer('price');
            $table->integer('real_price')->nullable();
            $table->string('cashier_name');
            $table->integer('discount')->nullable();
            $table->string('yawe_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pawn', function (Blueprint $table) {
            //
        });
    }
}
