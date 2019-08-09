<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Department')->nullable(false);
            $table->string('Position')->nullable(false);
            $table->string('Name')->nullable(false)->unique();
            $table->string('Login')->nullable(false)->unique();
            $table->string('Password')->nullable(false)->unique();
            $table->bigInteger('Phone')->nullable(false);
            $table->string('E-mail');
            $table->integer('Rights')->nullable(false);
            $table->integer('Age');
            $table->string('Address');
            $table->bigInteger('User_ID')->nullable(false);
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
        Schema::dropIfExists('employees');
    }
}
