<?php

namespace Gdinko\Acs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrierAcsApiStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
    ];
}
