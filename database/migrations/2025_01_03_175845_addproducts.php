<?php

use App\Models\brands;
use App\Models\Category;
use App\Models\inventory;
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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignIdFor(Category::class)->constrained(); 
            $table->foreignIdFor(brands::class)->constrained(); 
            $table->foreignIdFor(inventory::class)->constrained(); 
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
