<?php

namespace App\Http\Controllers;

use App\Exports\VariantExport;
use App\Imports\VariantImport;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class ProductVariantController extends Controller
{
    public function index() {
        $variants = ProductVariant::all();
        return view('dashboard.product_variants.index')
        ->with('variants', $variants);
    }

    public function create() {
        return view('dashboard.product_variants.create');
    }

    public function delete(Request $request) 
    {
        $ids = json_decode($request->input('selectedIds'));
        ProductVariant::destroy($ids);
        return redirect()->route('productVariants')->with('success', 'Product Variants deleted successfully!');
    }

    public function import(Request $request)
    {
        try {
            $this->validate($request, [
                'importFile' => 'required|mimes:xlsx|max:2048',
            ]);
            Excel::import(new VariantImport(), $request->file('importFile'));
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
    
    public function export(Request $request)
    {
        $exportOption = $request->input('exportOption');
        if ($exportOption == 'withData') {
            return Excel::download(new VariantExport(true), 'productVariants_with_Data.xlsx');
        } elseif ($exportOption == 'withoutData') {
            return Excel::download(new VariantExport(false), 'productVariants_without_data.xlsx');
        }
    }
}
