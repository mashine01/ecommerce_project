<?php

namespace App\Imports;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use function App\Helpers\validateHeaders;
use function App\Helpers\verifyDataExists;

class VariantImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        validateHeaders($row, [
            'upc',
            'quantity',
            'colour',
            'style_code',
            'size',
        ]);

        try {

            $validator = Validator::make($row, [
                'upc' => 'required',
                'quantity' => 'required|numeric',
                'colour' => 'required',
                'style_code' => 'required',
                'size' => 'required',
            ],
            [
                'upc.required' => 'UPC is required',
                'quantity.required' => 'Quantity is required',
                'quantity.numeric' => 'Quantity must be a number',
                'colour.required' => 'Colour is required',
                'style_code.required' => 'Style code is required',
                'size.required' => 'Size is required',
            ]);

            $product = verifyDataExists(Product::class, 'style_code', $row['style_code']);
            $sku = 
            strtoupper(substr(($product->brand->vendor->name),0,2)) .
            strtoupper(substr(($product->brand->name), 0, 2)) .
            strtoupper(substr(($product->vendor_style_code), 0, 2)) . "-" .
            strtoupper($row['colour']) . "-" .
            strtoupper($row['size']);

            $existingProduct = ProductVariant::where('sku', $sku)->first();
            if ($existingProduct && $existingProduct->UPC == $row['upc']) {
                throw new \Exception('SKU already exists with the same UPC: ' . $sku);
            }

            ProductVariant::updateOrCreate(
                ['upc' => $row['upc']],
                [
                    'quantity' => $row['quantity'],
                    'upc' => $row['upc'],
                    'colour' => $row['colour'],
                    'style_code' => $row['style_code'],
                    'size' => $row['size'],
                    'sku' => $sku,
                    'created_by' => auth()->user()->email,
                 
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception('Error updating or creating product: ' . $e->getMessage());
        }
    }
}
