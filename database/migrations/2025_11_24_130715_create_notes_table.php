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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deal_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content'); // ← ДОБАВЬТЕ ЭТО ПОЛЕ!
            $table->timestamps();
        });

        //        $this->createTable('note', [
        //            'id' => $this->primaryKey(),
        //            'deal_id' => $this->integer()->notNull(),
        //            'dt_add' => $this->dateTime()->defaultValue(new Expression('NOW()')),
        //            'user_id' => $this->integer()->notNull(),
        //            'content' => $this->text()
        //        ]);
        //
        //        $this->addForeignKey('user_note', 'note', 'user_id', 'user', 'id');
        //        $this->addForeignKey('deal_note', 'note', 'deal_id', 'deal', 'id');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
