<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->json('id_group')->nullable();
            $table->string('image')->nullable();
            $table->string('name');
            $table->date('birth');
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bank_name')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('name_account')->nullable();
            $table->string('id_card')->nullable();
            $table->string('selfie')->nullable();
            $table->rememberToken();
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
};
