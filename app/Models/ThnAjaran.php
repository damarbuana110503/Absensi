<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThnAjaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'FTHN_AJARAN';
    public $incrementing = false;

    protected $fillable = [
        'FTHN_AJARAN',
        'FBIAYA_SPP',
        'FBIAYA_DSP',
    ];
}
