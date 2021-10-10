<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;


    protected $fillable = [
        'type', 'original_name', 'original_extension', 'access_url', 'file_name',
        'file_extension', 'file_metadata'
    ];
}
