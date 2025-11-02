<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_notes', function (Blueprint $table) {
            $table->id();
            $table->string('center_no')->nullable();
            $table->date('date');
            $table->string('session');
            $table->string('subject_code');
            $table->string('paper_code');
            $table->string('message');

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
        Schema::dropIfExists('special_notes');
    }
}
