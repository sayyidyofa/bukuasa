<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Cart extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'carts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'faktur_id',
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

    public function faktur()
    {
        return $this->belongsTo(Faktur::class, 'faktur_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
