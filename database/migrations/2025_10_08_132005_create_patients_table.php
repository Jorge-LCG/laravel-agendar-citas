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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('blood_type_id')->nullable()->constrained()->onDelete('set null');
            $table->text('allergies')->nullable();
            $table->text('chronic_conditions')->nullable();
            $table->text('surgical_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('observations')->nullable();
            $table->string('emergency_contact_name', 60)->nullable();
            $table->string('emergency_contact_phone', 9)->nullable();
            $table->string('emergency_contact_relationship', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
