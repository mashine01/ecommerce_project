<?php

namespace App\Exports;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
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
                'products.name as name',
                'products.description as description',
                'brands.name as brand_name',
                'categories.name as category_name',
                'subcategories.name as subcategory_name',
                'price',
                'discount',
                'discount_price',
                'vendor_style_code',
            ];

            return(Product::with('brand:id,name', 'category:id,name')
                ->select($selectedColumns)
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
                ->get()
            );
        }
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Brand Name',
            'Category Name',
            'Subcategory Name',
            'Price',
            'Discount',
            'Discount Price',
            'Vendor Style Code',
        ];
    }
}