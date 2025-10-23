<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_dbs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('session');
            $table->string('subject_code');
            $table->string('paper_code');
            $table->string('medium_no');
            $table->string('center_no');
            $table->string('index_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_dbs');
    }
}
