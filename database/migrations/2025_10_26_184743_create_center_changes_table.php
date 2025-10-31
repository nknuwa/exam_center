<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenterChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_changes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('session');
            $table->string('subject_code');
            $table->string('paper_code');
            $table->string('index_no');
            $table->string('current_center_no');
            $table->string('new_center_no');

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
        Schema::dropIfExists('center_changes');
    }
}
