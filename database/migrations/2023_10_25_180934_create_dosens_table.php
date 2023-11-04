<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosens', function (Blueprint $table) {
            // $table->id();
            $table->char('FNO_KTP', 16);
            $table->char('FK_NIDN', 9)->primary();
            $table->string('FN_DOSEN');
            $table->char('FK_KEL', 5);
            $table->string('FTMP_LAHIR');
            $table->dateTime('FTGL_LAHIR');
            $table->string('FNO_TELP_HP');

            $table->char('FK_AGAMA');
            $table->char('FK_JURUSAN');

            $table->text('FALAMAT')->nullable();

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
        Schema::dropIfExists('dosens');
    }
}
