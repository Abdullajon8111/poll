<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminUserUniversity
 *
 * @property int $id
 * @property int $university_id
 * @property int $admin_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity whereAdminUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity whereUniversityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminUserUniversity whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminUserUniversity extends Model
{
    use HasFactory;

    protected $table = 'admin_user_university';
}
