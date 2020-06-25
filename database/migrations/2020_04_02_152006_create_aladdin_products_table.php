<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAladdinProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aladdin_products', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('name');
            $table->string('code')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('price');
            $table->string('count_method')->nullable();
            $table->string('photo')->nullable();
            $table->string('youtube')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aladdin_products');
    }
}
