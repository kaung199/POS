<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPawnPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pawn_photos', function (Blueprint $table) {
            $table->unsignedBigInteger('pawn_id')->nullable();
            $table->foreign('pawn_id')
                ->references('id')->on('pawn')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pawn_hpotos', function (Blueprint $table) {
            //
        });
    }
}
