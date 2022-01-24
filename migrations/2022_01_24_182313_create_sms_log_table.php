<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsLogTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('sms_logs')) {
            Schema::create('sms_logs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('mobile');
                $table->text('data')->nullable();
                $table->tinyInteger('is_sent')->default(0);
                $table->text('result')->nullable();
                $table->timestamps();

                $table->index('mobile');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}