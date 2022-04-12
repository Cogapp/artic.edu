<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtworkWebsiteUrlToArtworksTable extends Migration
{
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->text('artwork_website_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn('artwork_website_url');
        });
    }
}
