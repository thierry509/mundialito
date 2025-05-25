<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $sql = File::get(database_path('sql/view_rankings.sql'));
        DB::unprepared($sql);
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_rankings");
    }
};
