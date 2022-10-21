<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add3dModelIdToArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SQLite doesn't support column names that start with numbers,
        // so skip this in our testing environment
        if (env('APP_ENV') != 'testing') {
            Schema::table('artworks', function (Blueprint $table) {
                $table->unsignedInteger('3d_model_id')->nullable();
                $table->foreign('3d_model_id')
                    ->references('id')
                    ->on('3d_models')
                    ->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('3d_model_id');
        });
    }
}
