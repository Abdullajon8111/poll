<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Organization
 *
 * @property int $id
 * @property string|null $ktut
 * @property string|null $stir
 * @property string|null $name
 * @property string|null $region
 * @property string|null $district
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Organization newModelQuery()
 * @method static Builder|Organization newQuery()
 * @method static Builder|Organization query()
 * @method static Builder|Organization whereAddress($value)
 * @method static Builder|Organization whereCreatedAt($value)
 * @method static Builder|Organization whereDistrict($value)
 * @method static Builder|Organization whereEmail($value)
 * @method static Builder|Organization whereId($value)
 * @method static Builder|Organization whereKtut($value)
 * @method static Builder|Organization whereName($value)
 * @method static Builder|Organization wherePhone($value)
 * @method static Builder|Organization whereRegion($value)
 * @method static Builder|Organization whereStir($value)
 * @method static Builder|Organization whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Organization getByKtutAndStir($stir, $ktut)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property int|null $org_category_id
 * @property-read \App\Models\OrgCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\University[] $universities
 * @property-read int|null $universities_count
 * @method static Builder|Organization whereOrgCategoryId($value)
 */
class Organization extends Authenticatable
{
    use CrudTrait;
    use HasFactory;

    protected $guarded = ['id'];

    public function entries()
    {
        return $this->hasMany(Entry::class, 'participant_id');
    }

    public function category()
    {
        return $this->belongsTo(OrgCategory::class, 'org_category_id');
    }

    public function universities()
    {
        return $this->belongsToMany(
            University::class,
            'org_univer_pivot',
            'org_category_id',
            'univer_category_id',
            'org_category_id',
            'univer_category_id'
        );
    }
}
