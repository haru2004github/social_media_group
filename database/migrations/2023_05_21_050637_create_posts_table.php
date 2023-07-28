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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('description')->nullable(true);
            $table->string('image')->nullable(true);
            $table->integer('user_id');
            $table->string('saver_id')->default(0);
            $table->string('reactor_id')->default(0);
            $table->integer('feeling_id')->nullable(true);
            $table->integer('view_count')->default(0);
            $table->integer('reaction_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->string('post_approve')->default('not_approved');
            $table->string('status')->default('unseen');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
