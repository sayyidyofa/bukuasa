<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Overtime
 *
 * @property int $id
 * @property string $dept
 * @property \Illuminate\Support\Carbon $date
 * @property string $start_hour
 * @property string $end_hour
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime newQuery()
 * @method static \Illuminate\Database\Query\Builder|Overtime onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime query()
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereDept($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereEndHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereStartHour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Overtime whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Overtime withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Overtime withoutTrashed()
 * @mixin \Eloquent
 */
class Overtime extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'overtimes';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'dept',
        'date',
        'start_hour',
        'end_hour',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
