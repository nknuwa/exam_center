<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsenteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absentees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained('users')->onDelete('cascade');
            $table->time('session');
           $table->string('subject_code');
            $table->string('paper_code');
            $table->string('index_no');
            $table->id();

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
        Schema::dropIfExists('absentees');
    }
}
