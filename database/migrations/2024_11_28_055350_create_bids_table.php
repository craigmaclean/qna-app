<?php

use App\Models\User;
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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->tinyInteger('status_active');
            $table->string('project_name');
            $table->decimal('project_sqft');
            $table->string('client_first_name');
            $table->string('client_last_name');
            $table->string('client_company');
            $table->string('client_email');
            $table->string('client_phone');
            $table->decimal('general_conditions_percent')->nullable();
            $table->decimal('overhead_profit_percent')->nullable();
            $table->tinyInteger('tax_exempt');
            $table->decimal('tax_percent');
            $table->string('labor_days');
            $table->string('labor_unit_cost');
            $table->string('grand_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
