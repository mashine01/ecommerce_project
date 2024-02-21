<?php

namespace App\Http\Controllers;

use App\Exports\VariantExport;
use App\Imports\VariantImport;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariantController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::all();
        return view('dashboard.productVariants.index')
            ->with('variants', $variants);
    }

    public function edit(ProductVariant $variant)
    {
        $variantDetails = ProductVariant::join('products as p', 'product_variants.style_code', '=', 'p.style_code')
        ->join('vendors as v', 'p.vendor_id', '=', 'v.id')
        ->join('brands as b', 'p.brand_id', '=', 'b.id')
        ->select('product_variants.*', 'v.name as vendor_name', 'b.name as brand_name', 'p.vendor_style_code')
        ->where('product_variants.id', $variant->id)
        ->get();
        return view('dashboard.productVariants.edit')
            ->with('variant', $variant);
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $validator = Validator::make($request->all(), [
            'sku' => 'required|unique:product_variants,sku,' . $variant->id,
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'upc' => 'required|digits:9',
            'style_code' => 'required',
            'size' => 'required',
            'colour' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('productVariants.edit', $variant->id))
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $variant->save($validated);
        return redirect()->route('productVariants')->with('success', 'Product Variant updated successfully!');
    }

    public function delete(Request $request)
    {
        $ids = json_decode($request->input('selectedIds'));
        ProductVariant::destroy($ids);
        return redirect()->route('productVariants')->with('success', 'Product Variants deleted successfully!');
    }

    public function upload(Request $request)
    {
        try {
            $this->validate($request, [
                'excelFile' => 'required|mimes:xlsx|max:2048',
            ]);
            Excel::import(new VariantImport(), $request->file('excelFile'));
            return redirect()->route('productVariants')->with('success', 'Import successful!');
        } catch (ValidationException $e) {
            return redirect(route('productVariants'))
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->route('productVariants')
                ->with('error', 'An error occurred during import: ' . $e->getMessage());
        }
    }

    public function download(Request $request)
    {
        $exportOption = $request->input('download');
        if ($exportOption == 'WithData') {
            return Excel::download(new VariantExport(true), 'productVariants_with_Data.xlsx');
        } elseif ($exportOption == 'WithoutData') {
            return Excel::download(new VariantExport(false), 'productVariants_without_data.xlsx');
        }
    }
}
