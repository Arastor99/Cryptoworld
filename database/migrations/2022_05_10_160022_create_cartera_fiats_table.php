<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteraFiatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartera_fiats', function (Blueprint $table) {
            $table->id();
            $table->decimal('cantidad')->default(0);
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');
            $table->foreignId('fiat_id')->constrained('fiats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartera_fiats');
    }
}
