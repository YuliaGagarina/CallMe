<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Product group')->nullable(false);
            $table->string('Provider')->nullable(false);
            $table->string('Position')->nullable(false);
            $table->string('Name')->nullable(false);
            $table->bigInteger('Phone')->nullable(false);
            $table->string('E-mail');
            $table->bigInteger('Created by');
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
        Schema::dropIfExists('providers');
    }
}
