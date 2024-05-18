<?php

namespace GustoCoder\TyfoonSeo\database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tyfoon_seo_global', function (Blueprint $table) {
            $table->increments('id');
            $table->string('og_locale');
            $table->string('og_site');
            $table->string('og_article_publisher');
            $table->string('og_author');
            $table->string('geo_placename');
            $table->string('geo_region');
            $table->string('geo_position');
            $table->string('fb_id');
            $table->string('twitter_card');
            $table->string('twitter_site');
            $table->string('reflang_alternate1');
            $table->string('reflang_alternate2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tyfoon_seo_global');
    }
};
