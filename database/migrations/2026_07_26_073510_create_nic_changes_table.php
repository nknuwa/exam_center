<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNicChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nic_changes', function (Blueprint $table) {
            $table->id();

            $table->string('center_no');
            $table->date('date');
            $table->string('session');

            $table->string('subject_code');
            $table->string('paper_code');

            $table->string('index_no');
            $table->string('exam_id');

            $table->string('old_nic');
            $table->string('new_nic');

            $table->text('reason')->nullable();

            $table->foreignId('user_id');

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
        Schema::dropIfExists('nic_changes');
    }
}
