<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'events',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('legend_id')->nullable();
                $table->unsignedInteger('worker_id')->nullable()->default(null);
                $table->unsignedInteger('employer_id')->nullable()->default(null);
                $table->date('start');
                $table->date('end')->nullable()->default(null);
                $table->string('title', 80)->nullable()->default(null);
                $table->timestamps();
                
                $table->foreign('legend_id')
                    ->references('id')->on('legends')
                    ->onDelete('set null');

                $table->foreign('employer_id')
                    ->references('id')->on('employers')
                    ->onDelete('set null');

                $table->foreign('worker_id')
                    ->references('id')->on('workers')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}
