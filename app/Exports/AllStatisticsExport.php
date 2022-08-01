<?php

namespace App\Exports;

use App\Http\Controllers\Admin\AllAnswerController;
use App\Models\Entry;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AllStatisticsExport implements FromView
{

    public function view(): View
    {
        return (new AllAnswerController())->index(true);
    }
}
