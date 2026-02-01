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
        Schema::dropIfExists('feeds');

        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->string('type', 32);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('deal_id')->constrained('deals')->onDelete('cascade'); // Исправлено
            //            $table->string('value', 255);
            //            $table->foreignId('user_id')->nullable()->index();
            //            $table->integer('deal_id');
            $table->string('value');
            $table->timestamps();

            // Индексы для оптимизации если надо
            //            $table->index(['type', 'deal_id']);
            //            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feed');
    }
};
