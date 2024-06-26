<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'images';
    protected $fillable = [
        'filename',
        'type',
        'url',
        'size'
    ];
    protected $hidden = [
        'type',
        'size'
    ];
}