<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontosTable extends Migration
{
    public function up()
    {
        Schema::create('pontos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('lyrics_preview');
            $table->string('audio_url');
            $table->string('toque_image_url');
            $table->integer('order');
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pontos');
    }
}

