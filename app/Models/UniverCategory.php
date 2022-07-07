<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
