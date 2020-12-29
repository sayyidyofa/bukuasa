<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

/**
 * App\Models\FaqQuestion
 *
 * @property int $id
 * @property string|null $question
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $category_id
 * @property-read \App\Models\FaqCategory|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion newQuery()
 * @method static \Illuminate\Database\Query\Builder|FaqQuestion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FaqQuestion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|FaqQuestion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|FaqQuestion withoutTrashed()
 * @mixin \Eloquent
 */
class FaqQuestion extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'faq_questions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_id',
        'question',
        'answer',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'category_id');
    }
}
