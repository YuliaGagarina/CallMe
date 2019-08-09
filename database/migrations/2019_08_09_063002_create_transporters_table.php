<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Kind of transport')->nullable(false);
            $table->string('Transporter')->nullable(false);
            $table->string('Position')->nullable(false);
            $table->string('Name')->nullable(false);
            $table->bigInteger('Phone')->nullable(false);
            $table->string('E-mail');
            $table->bigInteger('Created by')->nullable(false);
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
        Schema::dropIfExists('transporters');
    }
}
