<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jurusan extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_JURUSAN';
    public $incrementing = false;

    protected $fillable = [
        'FK_JURUSAN',
        'FN_JURUSAN',
    ];
}
