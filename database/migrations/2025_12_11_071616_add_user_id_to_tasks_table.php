<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // 1.
            // $table->unsignedBigInteger('reporter_id')->nullable();
            // $table->foreign('reporter_id')->references('id')->on('users');
            // 2.
            // $table->foreignId('reporter_id')->nullable()->references('id')->on('users');
            // 3.
            $table->foreignIdFor(User::class, 'reporter_id')->nullable()->constrained();
            $table->foreignIdFor(User::class, 'assignee_id')->nullable()->constrained();
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(User::class, 'reporter_id');
            $table->dropConstrainedForeignIdFor(User::class, 'assignee_id');
        });
    }
};
