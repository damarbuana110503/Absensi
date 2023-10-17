<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FNIM';
    public $incrementing = false;

    protected $fillable = [
        'FNO_KTP',
        'FNIM',
        'FN_MAHASISWA',
        'FK_KEL',
        'FTMP_LAHIR',
        'FTGL_LAHIR',
        'FK_AGAMA',
        'FK_JURUSAN',
        'FTHN_AJARAN',
        'FSTATUS_AKTIF',
        'FASAL_SEKOLAH',
        'FNO_TELP_HP',
        'FN_AYAH',
        'FN_IBU',
        'FALAMAT',
        'FNO_TELP_AYAH',
    ];
}
