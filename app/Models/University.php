<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Str;

/**
 * App\Models\University
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|University newModelQuery()
 * @method static Builder|University newQuery()
 * @method static Builder|University query()
 * @method static Builder|University whereCreatedAt($value)
 * @method static Builder|University whereId($value)
 * @method static Builder|University whereName($value)
 * @method static Builder|University whereUpdatedAt($value)
 * @mixin Eloquent
 * @property string|null $slug
 * @property int $enabled
 * @property-read Collection|AdminUserUniversity[] $admins
 * @property-read int|null $admins_count
 * @method static Builder|University whereEnabled($value)
 * @method static Builder|University whereSlug($value)
 * @property-read Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property int|null $univer_category_id
 * @property-read \App\Models\UniverCategory|null $category
 * @property-read Collection|\App\Models\Organization[] $organizations
 * @property-read int|null $organizations_count
 * @method static Builder|University whereUniverCategoryId($value)
 */
class University extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    public function admins()
    {
        return $this->belongsToMany(AdminUser::class, 'admin_user_university');
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function category()
    {
        return $this->belongsTo(UniverCategory::class, 'univer_category_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'org_univer_pivot');
    }
}
