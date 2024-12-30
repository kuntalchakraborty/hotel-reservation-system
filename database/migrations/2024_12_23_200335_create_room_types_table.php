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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('max_occupancy')->default(2);
            $table->boolean('security')->default(false);
            $table->boolean('air_conditioned')->default(false);
            $table->boolean('free_wifi')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('restaurant')->default(false);
            $table->boolean('complimentary_breakfast')->default(false);
            $table->boolean('hair_dryer')->default(false);
            $table->boolean('mini_fridge')->default(false);
            $table->boolean('room_service')->default(false);
            $table->boolean('swimming_pool')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
