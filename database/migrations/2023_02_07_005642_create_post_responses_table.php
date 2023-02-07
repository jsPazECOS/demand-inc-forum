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
        Schema::create('post_responses', function (Blueprint $table) {
            $table->id();

            $table->text('response');
            $table->string('image')->nullable();

            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('post_id')->constrained('posts');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['title', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_responses');
    }
};
