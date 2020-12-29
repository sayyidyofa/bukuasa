<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Kasbon
 *
 * @property int $id
 * @property string $nominal
 * @property \Illuminate\Support\Carbon $cut_start
 * @property \Illuminate\Support\Carbon $cut_end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon newQuery()
 * @method static \Illuminate\Database\Query\Builder|Kasbon onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereCutEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereCutStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kasbon whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Kasbon withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Kasbon withoutTrashed()
 * @mixin \Eloquent
 */
class Kasbon extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'kasbons';

    protected $dates = [
        'cut_start',
        'cut_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'nominal',
        'cut_start',
        'cut_end',
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

    public function getCutStartAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCutStartAttribute($value)
    {
        $this->attributes['cut_start'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCutEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCutEndAttribute($value)
    {
        $this->attributes['cut_end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
