<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
