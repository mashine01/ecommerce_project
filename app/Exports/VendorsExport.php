<?php

namespace App\Exports;

use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendorsExport implements FromCollection, WithHeadings
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
            return Vendor::select("name")->get();
        }

        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Vendor Name',
        ];
    }

}
