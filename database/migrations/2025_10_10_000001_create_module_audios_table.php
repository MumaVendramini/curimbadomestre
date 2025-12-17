<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('module_audios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->string('file_path');
            $table->string('title')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('module_audios');
    }
};
