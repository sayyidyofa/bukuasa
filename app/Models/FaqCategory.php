<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\FaqCategory
 *
 * @property int $id
 * @property string|null $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|FaqCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|FaqCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|FaqCategory withoutTrashed()
 * @mixin \Eloquent
 */
class FaqCategory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'faq_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
