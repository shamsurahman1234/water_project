<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->decimal('previous_reading', 10, 2)->default(0)->change();
            $table->decimal('current_reading', 10, 2)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('meters', function (Blueprint $table) {
            $table->double('previous_reading')->default(0)->change();
            $table->double('current_reading')->default(0)->change();
        });
    }
};
