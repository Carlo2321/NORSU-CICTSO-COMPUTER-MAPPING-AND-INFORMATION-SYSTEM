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
        Schema::create('computers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('computerName');
            $table->string('ipAddress');
            $table->char('macAddress');
            $table->string('remarks')->nullable();
            $table->boolean('working')->default(true);
            $table->float('top')->default(0);
            $table->float('left')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.x
     */
    public function down(): void
    {
        Schema::table('computers', function (Blueprint $table) {
            $table->dropColumn(['top', 'left']);
        });
    }
};
