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
        Schema::create('tyfoon_seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_name');
            $table->string('meta_title_en');
            $table->string('meta_title_fre');
            $table->string('meta_title_es');
            $table->string('meta_desc_en');
            $table->string('meta_desc_fre');
            $table->string('meta_desc_es');
            $table->enum('dynamic', ['0', '1'])->default('0');
            $table->string('og_title_en');
            $table->string('og_title_fre');
            $table->string('og_title_es');
            $table->string('og_desc_en');
            $table->string('og_desc_fre');
            $table->string('og_desc_es');
            $table->string('og_image');
            $table->string('og_image_secure_url');
            $table->integer('og_image_width');
            $table->integer('og_image_height');
            $table->string('og_video');
            $table->string('og_type_en');
            $table->string('og_type_fre');
            $table->string('og_type_es');
            $table->string('og_url');
            $table->string('twitter_title_en');
            $table->string('twitter_title_fre');
            $table->string('twitter_title_es');
            $table->string('twitter_desc_en');
            $table->string('twitter_desc_fre');
            $table->string('twitter_desc_es');
            $table->string('twitter_image');
            $table->string('canonical_href');
            $table->enum('no_index', ['0', '1'])->default('0');
            $table->string('h1_text_en');
            $table->string('h1_text_fre');
            $table->string('h1_text_es');
            $table->string('h2_text_en');
            $table->string('h2_text_fre');
            $table->string('h2_text_es');
            $table->text('page_content_en');
            $table->text('page_content_fre');
            $table->text('page_content_es');
            $table->string('keywords_en');
            $table->string('keywords_fre');
            $table->string('keywords_es');
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
