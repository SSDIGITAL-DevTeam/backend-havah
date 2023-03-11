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
        Schema::create('reimburses', function (Blueprint $table) {
            $table->id();
            $table->integer('approval_rate')->unsigned();
            $table->foreignId('transfer_destination')->constrained('members')->onDelete('cascade');
            $table->string('transfer_amount');
            $table->string('description');
            $table->dateTime('approval_due_date');
            $table->foreignId('group_id')->constrained('group_chats')->onDelete('cascade');
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
        Schema::dropIfExists('reimburses');
    }
};
