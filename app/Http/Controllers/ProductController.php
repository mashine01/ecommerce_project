<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index')->with('products', $products);
    }

    public function addImage(Request $request)
    {
        $product = Product::find($request->product_id);
        $image = $request->file('image');
        $style_code = $product->style_code;
        $imageName = $style_code . '.' . $image->getClientOriginalExtension();
        $path = 'product_images/';
        $request->image->move($path, $imageName);
        $image_path = $path . $imageName;
        $product->image_path = $image_path;
        $product->save();
        return redirect()->route('products')->with('success', 'Product image added successfully');
    }

    public function delete(Request $request)
    {
        try {
            $ids = json_decode($request->selectedIds);
            Product::destroy($ids);
            return redirect()->route('products')
                ->with('success', 'Products deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('products')->with('error', 'Product is being used, cannot delete!');
        }
        return redirect()->route('products')
            ->with('success', 'Products deleted successfully.');
    }

    public function download(Request $request)
    {
        $downloadType = $request->input('download');
        if ($downloadType == 'WithData') {
            return Excel::download(new ProductExport(true), 'products_with_data.xlsx');
        } elseif ($downloadType == 'WithoutData') {
            return Excel::download(new ProductExport(false), 'products_without_data.xlsx');
        }
    }

    public function upload(Request $request)
    {
        try {
            $this->validate($request, [
                'excelFile' => 'required|mimes:xlsx',
            ]);
            Excel::import(new ProductImport(), $request->file('excelFile'));
            return redirect()->route('products')->with('success', 'Import successful!');
        } catch (ValidationException $e) {
            return redirect(route('products'))
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->route('products')
                ->with('error', 'An error occurred during import: ' . $e->getMessage());
        }
    }
}
