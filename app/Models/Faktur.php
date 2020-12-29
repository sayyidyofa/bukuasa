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
