<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Crew extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'crews';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ROLE_RADIO = [
        'driver'   => 'Supir',
        'unloader' => 'Bongkar',
    ];

    protected $fillable = [
        'delivery_id',
        'user_id',
        'role',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
