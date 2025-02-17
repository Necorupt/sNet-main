<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    use HasFactory;
    protected $fillable = [
        'src_id',
        'dst_id',
        'isSubscriber'
    ];

}
