<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('province')->default('')->commit('省');
            $table->string('city')->default('')->commit('市');
            $table->string('district')->default('')->commit('区');
            $table->string('address')->default('')->commit('具体地址');
            $table->unsignedInteger('zip')->default(000000)->commit('邮编');
            $table->string('contact_name')->default('')->commit('联系人');
            $table->string('contact_phone')->default('')->commit('联系电话');
            $table->dateTime('last_used_at')->nullable();
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
        Schema::dropIfExists('user_addresses');
    }
}
