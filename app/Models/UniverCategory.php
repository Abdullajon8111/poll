<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniverCategory extends Model
{
    use CrudTrait;

    protected $guarded = ['id'];

    public function universities()
    {
        return $this->hasMany(University::class);
    }
}
