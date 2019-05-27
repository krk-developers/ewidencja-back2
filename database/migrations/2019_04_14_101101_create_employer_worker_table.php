<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
                $table->date('contract_from')->default(DB::raw('CURRENT_TIMESTAMP'));  // umowa o pracę
                $table->date('contract_to')->nullable()->default(null);
                $table->float('part_time', 8, 2)->default(1);  // wymiar etatu
                
                // only one employee the same id at one employer
                $table->unique(['employer_id', 'worker_id']);
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
