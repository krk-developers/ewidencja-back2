<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiTokenColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table
                    ->string('api_token', 80)
                    ->after('password')
                    ->unique()
                    ->nullable()
                    ->default(null);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
            }
        );
    }
}
