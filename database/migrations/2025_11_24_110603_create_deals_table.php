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
        Schema::dropIfExists('deal_tags');
        Schema::dropIfExists('deals');
        Schema::dropIfExists('deal_statuses');

        Schema::create('deal_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // было:
            //            $table->unsignedBigInteger('company_id')->nullable();
            //            $table->unsignedBigInteger('status_id')->nullable();
            //            $table->unsignedBigInteger('contact_id')->nullable();
            //            $table->unsignedBigInteger('executor_id')->nullable();
            //            $table->date('due_date');
            //            $table->text('description');
            //            $table->integer('budget_amount');

            // исправлены ошибки:
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained('deal_statuses')->onDelete('set null');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('set null');
            $table->foreignId('executor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // создатель
            $table->date('due_date')->nullable(); // исправлен тип
            $table->text('description')->nullable(); // может быть пустым
            $table->integer('budget_amount')->default(0);
            //            $table->string('alias')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('deal_tags', function (Blueprint $table) {
            $table->id();
            //            // было
            //            $table->string('name')->unique();
            //            $table->unsignedBigInteger('deal_id');
            // исправлено
            $table->string('name')->unique();
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Затем вставляем данные | Нет, вставим в сидере !!! т.к. Миграция для структуры БД
        //        DB::table('deal_statuses')->insert([
        //            ['name' => 'Новый', 'alias' => 'new'],
        //            ['name' => 'Презентация', 'alias' => 'presentation'],
        //            ['name' => 'В работе', 'alias' => 'in-work'],
        //            ['name' => 'Завершен', 'alias' => 'completed'],
        //        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // было
        //        Schema::dropIfExists('deals');
        // исправлено
        Schema::dropIfExists('deal_tags');
        Schema::dropIfExists('deals');
        Schema::dropIfExists('deal_statuses');
    }
};
