<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE FUNCTION get_username (
                user_id INT
            ) RETURNS VARCHAR(255)
            BEGIN
                SELECT username
                FROM users
                WHERE user_id = user_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS get_username;');
    }
};
