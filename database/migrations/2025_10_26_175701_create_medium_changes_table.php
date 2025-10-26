<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediumChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medium_changes', function (Blueprint $table) {
            $table->id();
            $table->string('center_no');
            $table->date('date');
            $table->string('session');
            $table->string('subject_code');
            $table->string('paper_code');
            $table->string('index_no');
            $table->string('medium_no');
            $table->string('new_medium_no');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('medium_changes');
    }
}
