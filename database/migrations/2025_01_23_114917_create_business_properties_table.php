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
        Schema::create('business_properties', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number', 15);
            $table->enum('type_of_property', ['Hotel', 'Home']);
            $table->boolean('is_in_property')->default(0);
            $table->json('address')->nullable();
            $table->json('property_information');
            $table->boolean('is_property_registered')->nullable();
            $table->json('facilities')->nullable();
            $table->json('property_images'); // Ensure at least 6 images are uploaded in validation
            $table->enum('id_proof_name', ['PAN', 'Aadhar']);
            $table->string('aadhar_number')->nullable();
            $table->string('pancard_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_properties');
    }
};
