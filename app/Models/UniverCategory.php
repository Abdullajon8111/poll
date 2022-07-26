<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UniverCategory
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\University[] $universities
 * @property-read int|null $universities_count
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UniverCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UniverCategory extends Model
{
    use CrudTrait;
    use HasTranslations;

    protected $guarded = ['id'];
    protected $translatable = ['name'];

    public function universities()
    {
        return $this->hasMany(University::class);
    }
}
