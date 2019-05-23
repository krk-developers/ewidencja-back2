<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'employers',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('company')->nullable();
                $table->unsignedBigInteger('nip')->unique()->nullable();
                $table->string('street', 60)->nullable();
                $table->string('zip_code', 6)->nullable();
                $table->string('city', 30)->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('employers');
    }
}
