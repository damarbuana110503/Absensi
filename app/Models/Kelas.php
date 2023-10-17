<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_KELAS';
    public $incrementing = false;

    protected $fillable = [
        'FK_KELAS',
        'FN_KELAS',
        'FKET',
    ];
}
