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
        Schema::create('group_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('create_by')->constrained('users')->cascadeOnDelete();
            $table->string('name_group');
            $table->string('group_balance')->nullable();
            $table->string('color_profile')->nullable();
            $table->integer('approval')->nullable();
            $table->boolean('fund_storage')->nullable();
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
        Schema::dropIfExists('group_chats');
    }
};
