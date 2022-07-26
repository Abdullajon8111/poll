<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OrgCategory
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Organization[] $organizations
 * @property-read int|null $organizations_count
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrgCategory extends Model
{
    use CrudTrait;
    use HasTranslations;

    protected $guarded = ['id'];
    protected $translatable = ['name'];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
