<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Delivery
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property string $distance_type
 * @property string $weight_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Crew[] $deliveryCrews
 * @property-read int|null $delivery_crews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faktur[] $fakturs
 * @property-read int|null $fakturs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery newQuery()
 * @method static \Illuminate\Database\Query\Builder|Delivery onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereDistanceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Delivery whereWeightType($value)
 * @method static \Illuminate\Database\Query\Builder|Delivery withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Delivery withoutTrashed()
 * @mixin \Eloquent
 */
class Delivery extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'deliveries';

    const DISTANCE_TYPE_RADIO = [
        'near' => 'Dekat',
        'far'  => 'Jauh',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const WEIGHT_TYPE_RADIO = [
        'ordinary' => 'Kurang dari 500kg',
        'heavy'    => 'Lebih dari 500kg',
    ];

    protected $fillable = [
        'date',
        'distance_type',
        'weight_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function deliveryCrews()
    {
        return $this->hasMany(Crew::class, 'delivery_id', 'id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function fakturs()
    {
        return $this->belongsToMany(Faktur::class);
    }
}
