<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Phones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            // при создании внешнего ключа,
            // указывающего на автоматическое числовое поле,делаем указывающее поле
            // (поле внешнего ключа)
            // типа UNSIGNED.
            $table->text('name')->nullable(false);
            $table->text('address')->nullable(true);
            $table->bigInteger('phone')->nullable(false);
            $table->timestamps();
        });

        Schema::table('phones', function (Blueprint $table) {
            //связываем пользователя с его данными внешним ключом
            //   $table->foreign('user_id')->references('id')->on('users');
            //удаляя пользователя, удаляется вся инфа, которая с ним связана
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('phones');
    }
}
