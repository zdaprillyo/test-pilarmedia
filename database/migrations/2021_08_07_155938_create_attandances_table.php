<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttandancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attandances', function (Blueprint $table) {
            $table->id();
            $table->date('periode');
            $table->dateTime('masuk');
            $table->dateTime('keluar')->nullable();
            $table->enum('ket',['hadir','cuti','sakit']);
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('attandances');
    }
}