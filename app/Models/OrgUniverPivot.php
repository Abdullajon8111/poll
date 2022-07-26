<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\OrgUniverPivot
 *
 * @property int $id
 * @property int $org_category_id
 * @property int $univer_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OrgCategory|null $org_category
 * @property-read \App\Models\UniverCategory|null $univer_category
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot whereOrgCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot whereUniverCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrgUniverPivot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrgUniverPivot extends Pivot
{
    use CrudTrait;

    protected $table = 'org_univer_pivot';
    protected $guarded = ['id'];

    public function org_category()
    {
        return $this->belongsTo(OrgCategory::class);
    }

    public function univer_category()
    {
        return $this->belongsTo(UniverCategory::class);
    }
}
