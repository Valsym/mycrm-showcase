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
        Schema::dropIfExists('task_types');
        Schema::create('task_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Вставляем данные | Добавлю в сидере
        //        DB::table('contact_types')->insert([
        //            ['name' => 'Разработка'],
        //            ['name' => 'Маркетинг'],
        //            ['name' => 'Дизайн'],
        //            ['name' => 'Аналитика'],
        //            ['name' => 'Копирайтинг'],
        //        ]);

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->foreignId('type_id')->constrained('task_types');
            $table->foreignId('deal_id')->constrained();
            $table->foreignId('user_id')->constrained('users');
            //            $table->foreignId('executor_id')->constrained('users');
            $table->foreignId('executor_id')
                // ->after('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Исполнитель задачи. NULL если пользователь удален');
            $table->date('due_date')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });

        //        $this->createTable('task', [
        //            'id' => $this->primaryKey()->notNull(),
        //            'description' => $this->text()->notNull(),
        //            'executor_id' => $this->integer()->notNull(),
        //            'due_date' => $this->date(),
        //            'type_id' => $this->integer()->notNull(),
        //            'dt_add' => $this->dateTime()->defaultValue(new \yii\db\Expression('NOW()')),
        //            'deal_id' => $this->integer()->notNull()
        //        ]);
        //
        //        $this->addForeignKey('task_type_id', 'task', 'type_id', 'task_types', 'id');
        //        $this->addForeignKey('task_deal_id', 'task', 'deal_id', 'deal', 'id');
        //        $this->addForeignKey('task_executor_id', 'task', 'executor_id', 'user', 'id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
