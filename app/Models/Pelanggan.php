<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\Pelanggan
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $contact
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faktur[] $pelangganFakturs
 * @property-read int|null $pelanggan_fakturs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan newQuery()
 * @method static \Illuminate\Database\Query\Builder|Pelanggan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pelanggan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Pelanggan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Pelanggan withoutTrashed()
 * @mixin \Eloquent
 */
class Pelanggan extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'pelanggans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'contact',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pelangganFakturs()
    {
        return $this->hasMany(Faktur::class, 'pelanggan_id', 'id');
    }
}
