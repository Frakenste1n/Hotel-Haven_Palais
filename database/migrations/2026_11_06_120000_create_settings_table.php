<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('resort_settings');
        Schema::dropIfExists('resort_setting_groups');

        if (Schema::hasTable('page_contents')) {
            DB::table('page_contents')->where('page_key', 'about')->delete();

            foreach (['label', 'role', 'has_image'] as $column) {
                if (Schema::hasColumn('page_contents', $column)) {
                    DB::statement("ALTER TABLE page_contents DROP COLUMN `{$column}`");
                }
            }
        }

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_tagline')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_favicon')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_phone')->nullable();
            $table->string('site_whatsapp')->nullable();
            $table->text('site_address')->nullable();
            $table->string('site_maps_url', 2000)->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('asal_usul')->nullable();
            $table->string('founder_name')->nullable();
            $table->string('founder_image')->nullable();
            $table->string('founder_position')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
