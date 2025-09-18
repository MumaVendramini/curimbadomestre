<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurimbaFieldsToModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->enum('toque_type', ['ijexa', 'nago', 'samba_angola', 'congo', 'barravento'])->nullable()->after('description');
            $table->text('toque_origin')->nullable()->after('toque_type');
            $table->text('toque_characteristics')->nullable()->after('toque_origin');
            $table->text('toque_application')->nullable()->after('toque_characteristics');
            $table->string('audio_url')->nullable()->after('apostila_url');
            $table->string('image_url')->nullable()->after('audio_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn([
                'toque_type',
                'toque_origin', 
                'toque_characteristics',
                'toque_application',
                'audio_url',
                'image_url'
            ]);
        });
    }
}
