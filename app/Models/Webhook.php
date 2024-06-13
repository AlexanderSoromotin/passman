<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Webhook extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'resource_id',
        'request_url',
        'request_method',
        'token',
    ];
}
