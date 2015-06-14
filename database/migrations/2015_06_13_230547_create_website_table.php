<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->string('url')->unique();
            $table->string('ip');
            $table->string('ftp_host');
            $table->string('ftp_username');
            $table->string('ftp_password');
            $table->string('ssh_host');
            $table->string('ssh_username');
            $table->string('ssh_password');
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
        Schema::drop('websites');
    }
}
