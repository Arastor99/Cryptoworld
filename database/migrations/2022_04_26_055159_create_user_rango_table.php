<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRangoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_rango', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
            $table->foreignId('rango_id')->constrained();
            $table->primary(['user_id','rango_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_rango');
    }
}
