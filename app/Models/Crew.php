<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Crew
 *
 * @property int $id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $delivery_id
 * @property int $user_id
 * @property-read \App\Models\Delivery $delivery
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Crew newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew newQuery()
 * @method static \Illuminate\Database\Query\Builder|Crew onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew query()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereDeliveryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Crew withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Crew withoutTrashed()
 * @mixin \Eloquent
 */
class Crew extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'crews';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ROLE_RADIO = [
        'driver'   => 'Supir',
        'unloader' => 'Bongkar',
    ];

    protected $fillable = [
        'delivery_id',
        'user_id',
        'role',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
