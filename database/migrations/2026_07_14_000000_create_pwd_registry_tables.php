<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disability_types', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('barangays', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->string('district')->nullable();
            $table->timestamps();
        });

        Schema::create('pwd_registrants', function (Blueprint $table) {
            $table->id();
            $table->string('pwd_id_number', 40)->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix', 20)->nullable();
            $table->date('birth_date');
            $table->enum('sex', ['male', 'female', 'prefer_not_to_say']);
            $table->string('civil_status')->nullable();
            $table->text('address_line');
            $table->string('contact_number', 30)->nullable();
            $table->string('email')->nullable();
            $table->foreignId('barangay_id')->constrained()->restrictOnDelete();
            $table->foreignId('disability_type_id')->constrained()->restrictOnDelete();
            $table->string('disability_cause')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number', 30)->nullable();
            $table->string('photo_path')->nullable();
            $table->date('card_issued_date')->nullable();
            $table->date('card_expiry_date')->nullable();
            $table->enum('card_status', ['active', 'expired', 'suspended', 'lost'])->default('active');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->index(['last_name', 'first_name']);
            $table->index('card_expiry_date');
        });

        Schema::create('pwd_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pwd_registrant_id')->constrained()->cascadeOnDelete();
            $table->string('application_number', 40)->unique();
            $table->enum('type', ['new', 'renewal', 'replacement', 'update']);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->enum('status', ['draft', 'pending', 'under_review', 'approved', 'rejected'])->default('draft');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['status', 'submitted_at']);
        });

        Schema::create('application_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pwd_application_id')->constrained('pwd_applications')->cascadeOnDelete();
            $table->string('document_type');
            $table->string('file_path');
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_documents');
        Schema::dropIfExists('pwd_applications');
        Schema::dropIfExists('pwd_registrants');
        Schema::dropIfExists('barangays');
        Schema::dropIfExists('disability_types');
    }
};
