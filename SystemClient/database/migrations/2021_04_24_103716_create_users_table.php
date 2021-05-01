<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->integer('role_id');
            $table->string('imie');
            $table->string('nazwisko');
            $table->string('haslo');
            $table->string('numer_telefonu')->nullable();
            $table->string('miasto')->nullable();
            $table->string('kodpocztowy')->nullable();
            $table->string('ulica')->nullable();
            $table->string('numermieszkania')->nullable();
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
        Schema::dropIfExists('users');
    }
}
