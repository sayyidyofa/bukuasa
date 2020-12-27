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

class Pembayaran extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'pembayarans';

    protected $appends = [
        'payment_proof',
    ];

    protected $dates = [
        'payment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const HOLDER_RADIO = [
        'secretary' => 'Sekretaris',
        'overseer'  => 'Pengawas',
        'owner'     => 'Pemilik',
    ];

    const TYPE_RADIO = [
        'kontan'      => 'Kontan',
        'baru'        => 'Angsuran Pertama',
        'lanjutan'    => 'Angsuran Lanjutan',
        'dp'          => 'DP',
        'dp_lanjutan' => 'Lanjutan DP',
    ];

    protected $fillable = [
        'faktur_id',
        'customer_id',
        'type',
        'holder',
        'nth_payment',
        'nominal',
        'payment_date',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'faktur_id');
    }

    public function customer()
    {
        return $this->belongsTo(Pelanggan::class, 'customer_id');
    }

    public function getPaymentDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getPaymentProofAttribute()
    {
        $file = $this->getMedia('payment_proof')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
}
