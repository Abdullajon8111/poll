<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class OrgUniverPivot extends Model
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
