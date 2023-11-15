<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_JADWAL';
    public $incrementing = false;

    protected $fillable = [
        'FK_JADWAL',
        'FK_MATKUL',
        'FK_NIDN',
        'FK_JURUSAN',
        'FTGL',
        'FJAM_MULAI',
        'FJAM_KELUAR',
        'FSTATUS_JADWAL',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'FK_JURUSAN', 'FK_JURUSAN');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'FK_NIDN', 'FK_NIDN');
    }

    public function matkul()
    {
        return $this->belongsTo(Matkul::class, 'FK_MATKUL', 'FK_MATKUL');
    }

}
