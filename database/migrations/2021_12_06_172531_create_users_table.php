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
            $table->string('first_name',60)->nullable(false);
            $table->string('last_name',60)->nullable(true);
            $table->string('username',100)->unique()->nullable(false);
            $table->string('email',125)->unique()->nullable(false);
            $table->string('password',125)->nullable(false);
            $table->string('phone',20)->nullable();
            $table->string('address',125)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->text('bio')->nullable();
            $table->string('api_token',125)->nullable(true);
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->timestamps();

            $table->foreign('gender_id')
                ->references('id')
                ->on('genders')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
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
        Schema::dropIfExists('users');
    }
}
