<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_category_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('summary')->nullable();
            $table->decimal('base_price', 15, 2);
            $table->unsignedTinyInteger('capacity_adults')->default(2);
            $table->unsignedTinyInteger('capacity_children')->default(0);
            $table->string('bed_type')->nullable();
            $table->decimal('room_size', 8, 2)->nullable()->comment('in square meters');
            $table->unsignedTinyInteger('max_occupancy')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
