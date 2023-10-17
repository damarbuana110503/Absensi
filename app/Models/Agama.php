<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agama extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FK_AGAMA';
    public $incrementing = false;

    protected $fillable = [
        'FK_AGAMA',
        'FN_AGAMA',
    ];
}
