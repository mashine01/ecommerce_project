<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Category;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $includeData;

    public function __construct($includeData = true)
    {
        $this->includeData = $includeData;
        return $includeData;
    }

    public function collection()
    {
        if ($this->includeData) {
            return Category::select("name")->get();
        }

        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Category Name',
        ];
    }
}