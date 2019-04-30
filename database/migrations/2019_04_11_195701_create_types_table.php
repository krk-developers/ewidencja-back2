<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'types',
            function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('registrable');
                $table->string('model', 30)->unique();
                $table->string('name', 20)->unique();
                $table->string('display_name', 40);
                $table->string('description', 120)->nullable();
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
        Schema::dropIfExists('user_types');
    }
}
