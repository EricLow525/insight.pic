<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('primary_text',50)->nullable();
            $table->string('secondary_text',50)->nullable();
            $table->string('primary_font',50)->nullable();
            $table->string('secondary_font',50)->nullable();
            $table->integer('primary_fontsize')->nullable();
            $table->integer('secondary_fontsize')->nullable();
            $table->integer('design_id')->nullable();
            $table->integer('primary_color_id')->nullable();
            $table->integer('secondary_color_id')->nullable();
            $table->double('primary_txtWidth', 15, 8)->nullable();
            $table->double('secondary_txtWidth', 15, 8)->nullable();
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
        Schema::drop('profiles');
    }
}
