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
 * App\Models\Pembayaran
 *
 * @property int $id
 * @property string $type
 * @property string $holder
 * @property int|null $nth_payment
 * @property string $nominal
 * @property \Illuminate\Support\Carbon $payment_date
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $customer_id
 * @property int $faktur_id
 * @property-read \App\Models\Pelanggan $customer
 * @property-read \App\Models\Faktur $faktur
 * @property-read mixed $payment_proof
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newQuery()
 * @method static \Illuminate\Database\Query\Builder|Pembayaran onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereFakturId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereHolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereNominal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereNthPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Pembayaran withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Pembayaran withoutTrashed()
 * @mixin \Eloquent
 */
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

    public static function boot()
    {
        parent::boot();
        Pembayaran::observe(new \App\Observers\PembayaranActionObserver);
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
