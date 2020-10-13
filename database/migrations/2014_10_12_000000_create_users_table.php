<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void                $table->foreign('user_id')

     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->unsignedInteger('user_status_id')->default(2);
            $table->foreign('user_status_id')
                ->references('id')
                ->on('user_status');

            $table->unsignedInteger('user_type_id')->default(1);
            $table->foreign('user_type_id')
                ->references('id')
                ->on('user_types');

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
//        Schema::dropIfExists('users');
    }
}
