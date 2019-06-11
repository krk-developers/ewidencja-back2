<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'workers',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('lastname', 30)->nullable();
                $table->unsignedBigInteger('pesel')->unique()->nullable();
                $table->boolean('equivalent')->default(0);  // ekwiwalent
                $table->decimal('equivalent_amount', 6, 2)->default(0);  // kwota ekwiwalentu
                $table->tinyInteger('effective')->default(1);  // etat efektywny
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
        Schema::dropIfExists('workers');
    }
}
