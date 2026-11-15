
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facility_reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('resort_facility_id')
                ->constrained('resort_facilities')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone', 30);

            $table->date('reservation_date');
            $table->string('session');
            $table->string('guest_type');

            $table->text('special_requests')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->index(['reservation_date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_reservations');
    }
};
