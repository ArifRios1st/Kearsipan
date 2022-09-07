<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('letter_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('sender');
            $table->string('regarding');
            $table->date('received_at')->nullable();
            $table->date('date')->nullable();
            $table->string('disposition');
            $table->unsignedBigInteger('servicer_id')->nullable();
            $table->foreign('servicer_id')->references('id')->on('servicers');
            $table->timestamps();
            $table->softDeletes();
        });
    }

};
