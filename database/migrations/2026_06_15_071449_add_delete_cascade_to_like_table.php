<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['tip_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('tip_id')
                ->references('id')
                ->on('tips')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['tip_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('tip_id')
                ->references('id')
                ->on('tips');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }
};
