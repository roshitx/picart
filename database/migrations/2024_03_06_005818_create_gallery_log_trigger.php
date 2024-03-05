<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
                CREATE TRIGGER after_insert_gallery
                AFTER INSERT ON galleries
                FOR EACH ROW
                BEGIN
                    INSERT INTO gallery_logs (gallery_id, action, created_at)
                    VALUES (NEW.id, \'INSERT\', now());
                END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_gallery');
    }
};
