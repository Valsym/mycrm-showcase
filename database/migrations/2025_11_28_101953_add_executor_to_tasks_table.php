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
        //        Schema::table('tasks', function (Blueprint $table) {
        //            $table->foreignId('executor_id')->constrained('users');
        //        });
        //        Schema::table('tasks', function (Blueprint $table) {
        //            $table->foreignId('executor_id')
        //                ->after('user_id')
        //                ->constrained('users')
        //                ->nullOnDelete(); // устанавливает NULL при удалении пользователя
        //        });
        if (! Schema::hasColumn('tasks', 'executor_id')) {
            Schema::table('tasks', function (Blueprint $table) {
                $table->foreignId('executor_id')
                    ->after('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete()
                    ->comment('Исполнитель задачи. NULL если пользователь удален');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
