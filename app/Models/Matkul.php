<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Matkul extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_MATKUL';
    public $incrementing = false;

    protected $fillable = [
        'FK_MATKUL',
        'FN_MATKUL',

        'FK_JURUSAN',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'FK_JURUSAN', 'FK_JURUSAN');
    }
}
