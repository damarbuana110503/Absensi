<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $primaryKey = 'FK_NIDN';
    public $incrementing = false;

    protected $fillable = [
        'FNO_KTP', 
        'FK_NIDN', 
        'FN_DOSEN', 
        'FK_KEL', 
        'FTMP_LAHIR', 
        'FTGL_LAHIR', 
        'FNO_TELP_HP', 
        'FK_AGAMA', 
        'FK_JURUSAN', 
        'FALAMAT', 
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'FK_JURUSAN', 'FK_JURUSAN');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'FK_AGAMA', 'FK_AGAMA');
    }
}
