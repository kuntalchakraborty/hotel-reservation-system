<?php

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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->constrained('room_types');
            $table->string('room_number')->unique(); // Unique room number to identify rooms easily
            $table->decimal('price', 8, 2); // Price per night or stay
            $table->boolean('available')->default(true); // Whether the room is available or not
            $table->integer('bed_count')->default(1); // Number of beds in the room
            $table->string('bed_type')->nullable(); // Type of bed, e.g., King, Queen, Single, etc.
            $table->integer('floor_number')->default(1); // Floor number of the room
            $table->enum('room_status', ['available', 'occupied'])->default('available'); // Room status
            $table->timestamp('available_from')->nullable(); // Time when the room becomes available again
            $table->timestamp('available_until')->nullable(); // Time when the room is no longer available
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
