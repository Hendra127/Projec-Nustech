<?php

namespace App\Exports;

use App\Models\NewProject;
use Maatwebsite\Excel\Concerns\FromCollection;

class NewProjectExport implements FromCollection
{
    public function collection()
    {
        return NewProject::all();
    }
}

