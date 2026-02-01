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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('email', 128)->unique();
            $table->string('name', 128)->nullable();
            $table->string('url', 128)->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('address', 255)->nullable();
            //            'ogrn' => 'ОГРН'
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
