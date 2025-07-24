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
        Schema::table('users', function (Blueprint $table) {
        $table->text('bio')->nullable()->after('password');
        $table->enum('user_type', ['entrepreneur', 'consultant'])->default('entrepreneur')->after('bio');
        $table->string('avatar')->nullable()->after('user_type');
        $table->string('specialization')->nullable()->after('avatar');
        $table->integer('experience')->nullable()->after('specialization');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
