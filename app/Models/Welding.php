<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Welding
 *
 * @property int $id
 * @property float $weight_kg
 * @property int $amount_unit
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $user_id
 * @property int $product_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Welding newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Welding newQuery()
 * @method static \Illuminate\Database\Query\Builder|Welding onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Welding query()
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereAmountUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Welding whereWeightKg($value)
 * @method static \Illuminate\Database\Query\Builder|Welding withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Welding withoutTrashed()
 * @mixin \Eloquent
 */
class Welding extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'weldings';

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date',
        'user_id',
        'product_id',
        'weight_kg',
        'amount_unit',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
