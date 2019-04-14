<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployerWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'employer_worker',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('employer_id');
                $table->integer('worker_id');
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
        Schema::dropIfExists('employer_worker');
    }
}
