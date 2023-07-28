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
        Schema::create('direct_chats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->string('message')->nullable(true);
            $table->string('image')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_chats');
    }
};
