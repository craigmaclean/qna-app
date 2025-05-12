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
        Schema::create('bids_sub_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bid_id')->constrained('bids')->onDelete('cascade');
            // Foreign keys to services and sub_services tables
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('sub_service_id')->constrained('sub_services')->onDelete('cascade');
            // Extra fields
            $table->string('units');
            $table->decimal('quantity');
            $table->decimal('adjusted_unit_cost');
            $table->decimal('total_cost');
            $table->decimal('markup_percent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids_sub_services');
    }
};
