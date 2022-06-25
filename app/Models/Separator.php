<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Separator
 *
 * @property int $id
 * @property int $university_id
 * @property int $admin_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AdminUser|null $admin_user
 * @property-read \App\Models\University|null $university
 * @method static \Illuminate\Database\Eloquent\Builder|Separator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Separator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Separator query()
 * @method static \Illuminate\Database\Eloquent\Builder|Separator whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Separator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Separator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Separator whereUniversityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Separator whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Separator extends Model
{
    use CrudTrait;

    protected $table = 'admin_user_university';
    protected $fillable = ['university_id', 'admin_user_id'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function admin_user()
    {
        return $this->belongsTo(AdminUser::class);
    }
}
