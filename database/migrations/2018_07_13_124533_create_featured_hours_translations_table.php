<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturedHoursTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('featured_hour_translations', function (Blueprint $table) {
            createDefaultTranslationsTableFields($table, 'featured_hour');
            $table->string('title')->nullable();
            $table->text('copy')->nullable();
        });

        Schema::table('featured_hours', function (Blueprint $table) {
            $table->dropColumn(['title', 'copy']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('featured_hour_translations');
        Schema::table('featured_hours', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('copy')->nullable();
        });
    }
}
