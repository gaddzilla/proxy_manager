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
        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->string('host');
            $table->unsignedSmallInteger('port'); // порт 1-65535
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default('unknown');
            $table->timestamp('checked_at')->nullable();
            $table->text('last_error')->nullable();
            $table->timestamps();
            $table->unique(['host', 'port', 'username']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxies');
    }
};
