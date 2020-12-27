<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Delivery extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'deliveries';

    const DISTANCE_TYPE_RADIO = [
        'near' => 'Dekat',
        'far'  => 'Jauh',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const WEIGHT_TYPE_RADIO = [
        'ordinary' => 'Kurang dari 500kg',
        'heavy'    => 'Lebih dari 500kg',
    ];

    protected $fillable = [
        'date',
        'distance_type',
        'weight_type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function deliveryCrews()
    {
        return $this->hasMany(Crew::class, 'delivery_id', 'id');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function fakturs()
    {
        return $this->belongsToMany(Faktur::class);
    }
}
