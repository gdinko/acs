<?php

namespace Gdinko\Acs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Gdinko\Acs\Models\CarrierAcsApiStatus
 *
 * @property int $id
 * @property int $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsApiStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarrierAcsApiStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
    ];
}
