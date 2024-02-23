<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use function App\Helpers\validateHeaders;
use function App\Helpers\verifyDataExists;

class ProductImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{

    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        validateHeaders($row, [
            "name",
            "description",
            "brand_name",
            "category_name",
            "subcategory_name",
            "price",
            "discount",
            "discount_price",
            "vendor_style_code"
        ]);

        try {

            $validator = Validator::make(
                $row,
                [
                    'name' => 'required',
                    'description' => 'required',
                    'brand_name' => 'required',
                    'category_name' => 'required',
                    'subcategory_name' => 'required',
                    'price' => 'required|numeric',
                    'discount' => 'required|numeric',
                    'discount_price' => 'required|numeric',
                    'vendor_style_code' => 'required',
                ],
                [
                    'name.required' => 'Name is required',
                    'description.required' => 'Description is required',
                    'brand_name.required' => 'Brand name is required',
                    'category_name.required' => 'Category name is required',
                    'subcategory_name.required' => 'Subcategory name is required',
                    'price.required' => 'Price is required',
                    'price.numeric' => 'Price must be a number',
                    'discount.required' => 'Discount is required',
                    'discount.numeric' => 'Discount must be a number',
                    'discount_price.required' => 'Discount price is required',
                    'discount_price.numeric' => 'Discount price must be a number',
                    'vendor_style_code.required' => 'Vendor style code is required',
                ]
            );

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $brand = verifyDataExists(Brand::class, "name", $row["brand_name"]);
            $category = verifyDataExists(Category::class, "name", $row["category_name"]);
            $subcategory = verifyDataExists(SubCategory::class, "name", $row["subcategory_name"]);

            $style_code = strtoupper(substr($row['brand_name'], 0, 2))
                . "-"
                . $row['vendor_style_code'];

            Product::updateOrCreate(
                ['style_code' => $style_code,],
                [
                    'vendor_id' => $brand->vendor->id,
                    'brand_id' => $brand->id,
                    'category_id' => $category->id,
                    'sub_category_id' => $subcategory->id,
                    'name' => $row['name'],
                    'description' => $row['description'],
                    'price' => $row['price'],
                    'discount' => $row['discount'],
                    'discount_price' => $row['discount_price'],
                    'vendor_style_code' => $row['vendor_style_code'],
                    'style_code' => $style_code,
                    'created_by' => auth()->user()->name,

                ]
            );
        } catch (\Exception $e) {
            throw new \Exception('Error updating or creating product: ' . $e->getMessage());
        }
    }
}
