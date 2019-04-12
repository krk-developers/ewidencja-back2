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
                $table->string('model', 30);  // ->nullable()
                $table->string('name', 20);  // ->nullable()
                $table->string('display_name', 40);  // ->nullable()
                $table->string('description', 120)->nullable();
                // $table->timestamps();
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
