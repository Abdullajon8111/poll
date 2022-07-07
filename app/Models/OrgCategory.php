<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrgCategory extends Model
{
    use CrudTrait;

    protected $guarded = ['id'];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
