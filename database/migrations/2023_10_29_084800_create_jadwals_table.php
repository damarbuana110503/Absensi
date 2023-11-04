<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            // $table->id();
            $table->char('FK_JADWAL', 5)->primary();
            $table->char('FK_MATKUL');
            $table->char('FK_NIDN');
            $table->char('FK_JURUSAN');
            $table->dateTime('FTGL');
            $table->dateTime('FJAM_MULAI');
            $table->dateTime('FJAM_KELUAR');
            $table->dateTime('FSTATUS_JADWAL');

            $table->softDeletes();
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
        Schema::dropIfExists('jadwals');
    }
}
