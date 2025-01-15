<?php

use App\Models\attributes_name;
use App\Models\attributes_value;
use App\Models\variant;
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
        Schema::create('variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(variant::class)->constrained();
            $table->foreignIdFor(attributes_name::class)->constrained();
            $table->foreignIdFor(attributes_value::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_attributes');
    }
};
