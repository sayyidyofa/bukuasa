<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Salary
 *
 * @property int $id
 * @property string $nominal
 * @property string|null $markup
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon $from
 * @property \Illuminate\Support\Carbon $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Salary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salary newQuery()
 * @method static \Illuminate\Database\Query\Builder|Salary onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Salary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereMarkup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salary whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Salary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Salary withoutTrashed()
 * @mixin \Eloquent
 */
class Salary extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'salaries';

    protected $dates = [
        'from',
        'to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'nominal',
        'markup',
        'keterangan',
        'from',
        'to',
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

    public function getFromAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFromAttribute($value)
    {
        $this->attributes['from'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getToAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setToAttribute($value)
    {
        $this->attributes['to'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
