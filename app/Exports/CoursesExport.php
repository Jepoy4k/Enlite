<?php

namespace app\Exports;

use App\Models\CourseManagement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoursesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CourseManagement::all();
    }

    /**
     * Define the column headings
     * 
     * @return array
     */
    public function headings(): array
    {
        return [
            'CourseID',
            'Description',
            'Credits'
        ];
    }
}


