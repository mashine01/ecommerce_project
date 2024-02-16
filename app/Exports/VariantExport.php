<?php

namespace App\Exports;

use App\Models\ProductVariant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VariantExport implements FromCollection, WithHeadings
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
            $selectedColumns = [
                'upc',
                'product_variants.quantity as quantity',
                'colour',
                'product_variants.style_code as style_code',
                'size',
            ];

            return(ProductVariant::select($selectedColumns)
                ->join('products', 'product_variants.style_code', '=', 'products.style_code')
                ->get()
            );
        }
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'UPC',
            'Quantity',
            'Colour',
            'Style Code',
            'Size',
        ];
    }
}
