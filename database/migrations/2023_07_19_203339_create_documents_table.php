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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('scholarship_application_id');
            $table->foreign('scholarship_application_id')->references('id')->on('scholarship_applications')->onDelete('cascade');
            $table->string('certificate_of_origin')->nullable();
            $table->string('admission_letter')->nullable();
            $table->string('birth_certificate_declaration')->nullable();
            $table->string('fee_schedule')->nullable();
            $table->string('fee_receipt')->nullable();
            $table->string('attestation_letter')->nullable();
            $table->string('applicant_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
