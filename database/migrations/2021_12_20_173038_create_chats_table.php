<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_seen')->nullable(false);
            $table->boolean('is_forward')->nullable(true);
            $table->text('message')->nullable(true);
            $table->unsignedBigInteger('first_user_id')->nullable();
            $table->unsignedBigInteger('second_user_id')->nullable();
            $table->timestamps();

            $table->foreign('first_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');
            $table->foreign('second_user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
