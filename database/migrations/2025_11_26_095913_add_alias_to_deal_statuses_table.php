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
        Schema::table('deal_statuses', function (Blueprint $table) {
            $table->string('alias')->nullable();
        });
        //        Schema::table('deals', function (Blueprint $table) {
        //            $table->dropColumn('alias'); });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deal_statuses', function (Blueprint $table) {
            //
        });
    }
};
