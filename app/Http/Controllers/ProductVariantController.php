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
        return view('dashboard.productVariants.index')
        ->with('variants', $variants);
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
