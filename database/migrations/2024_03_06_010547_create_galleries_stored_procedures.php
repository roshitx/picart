<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared(
            'CREATE PROCEDURE  GetUsers()
                    BEGIN
                        SELECT * FROM users;
                    END;'
        );
        DB::unprepared(
            'CREATE PROCEDURE  GetUserByID(IN `id` BIGINT)
                    BEGIN
                        SELECT * FROM users WHERE id = id;
                    END;'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetUsers;'
        );
        DB::unprepared(
            'DROP PROCEDURE IF EXISTS GetUserByID;'
        );
    }
};
