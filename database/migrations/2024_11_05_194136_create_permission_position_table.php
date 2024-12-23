<?php

use App\Models\Permission;
use App\Models\Position;
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
        Schema::create('permission_position', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Position::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Permission::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_position');
    }
};
