<?php

namespace Gdinko\Acs\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Gdinko\Acs\Models\CarrierAcsTracking
 *
 * @property int $id
 * @property string $carrier_signature
 * @property string $carrier_account
 * @property int $parcel_id
 * @property array|null $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereCarrierAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereCarrierSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereParcelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarrierAcsTracking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarrierAcsTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrier_signature',
        'carrier_account',
        'parcel_id',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
