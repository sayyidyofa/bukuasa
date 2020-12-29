<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

/**
 * App\Models\Faktur
 *
 * @property int $id
 * @property int $no_faktur
 * @property \Illuminate\Support\Carbon $tgl_faktur
 * @property string $tagihan
 * @property string|null $diskon_markup
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $pelanggan_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cart[] $fakturCarts
 * @property-read int|null $faktur_carts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Delivery[] $fakturDeliveries
 * @property-read int|null $faktur_deliveries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Pembayaran[] $fakturPembayarans
 * @property-read int|null $faktur_pembayarans_count
 * @property-read mixed $photo
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Pelanggan $pelanggan
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur newQuery()
 * @method static \Illuminate\Database\Query\Builder|Faktur onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereDiskonMarkup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereNoFaktur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur wherePelangganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereTagihan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereTglFaktur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faktur whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Faktur withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Faktur withoutTrashed()
 * @mixin \Eloquent
 */
class Faktur extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'fakturs';

    protected $appends = [
        'photo',
    ];

    protected $dates = [
        'tgl_faktur',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pelanggan_id',
        'no_faktur',
        'tgl_faktur',
        'tagihan',
        'diskon_markup',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        Faktur::observe(new \App\Observers\FakturActionObserver);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function fakturCarts()
    {
        return $this->hasMany(Cart::class, 'faktur_id', 'id');
    }

    public function fakturPembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'faktur_id', 'id');
    }

    public function fakturDeliveries()
    {
        return $this->belongsToMany(Delivery::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function getTglFakturAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTglFakturAttribute($value)
    {
        $this->attributes['tgl_faktur'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
