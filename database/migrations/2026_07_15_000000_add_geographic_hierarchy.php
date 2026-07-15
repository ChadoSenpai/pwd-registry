<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->string('region_code', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->foreignId('province_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });

        Schema::table('barangays', function (Blueprint $table) {
            $table->foreignId('municipality_id')->nullable()->after('district')->constrained()->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('barangays', function (Blueprint $table) {
            $table->dropForeign(['municipality_id']);
            $table->dropColumn('municipality_id');
        });

        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('provinces');
    }
};
