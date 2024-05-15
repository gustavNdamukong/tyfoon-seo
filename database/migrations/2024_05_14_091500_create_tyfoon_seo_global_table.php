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
            $table->string('og_geo_placename');
            $table->string('og_geo_region');
            $table->string('og_geo_position');
            $table->string('og_fb_id');
            $table->string('og_twitter_card');
            $table->string('og_twitter_site');
            $table->string('og_reflang_alternate1');
            $table->string('og_reflang_alternate2');
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
