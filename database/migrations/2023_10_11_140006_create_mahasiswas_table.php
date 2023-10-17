<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            // $table->id();
            $table->char('FNO_KTP', 16);
            $table->char('FNIM', 9)->primary();
            $table->string('FN_MAHASISWA');
            $table->char('FK_KEL', 5);
            $table->string('FTMP_LAHIR');
            $table->dateTime('FTGL_LAHIR');

            $table->char('FK_AGAMA');
            $table->char('FK_JURUSAN');
            $table->char('FTHN_AJARAN');

            $table->char('FSTATUS_AKTIF');
            $table->string('FASAL_SEKOLAH');
            $table->string('FNO_TELP_HP');
            $table->text('FN_AYAH')->nullable();
            $table->text('FN_IBU')->nullable();
            $table->text('FALAMAT')->nullable();
            $table->string('FNO_TELP_AYAH');

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
        Schema::dropIfExists('mahasiswas');
    }
}
