<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Vendor;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BrandsExport;
use App\Imports\BrandsImport;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        $vendors = Vendor::all();
        return view('dashboard.brands.index', compact('brands', 'vendors'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        return view('dashboard.brands.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:brands,name,',
                ],
                'vendor_id' => [
                    'required',
                    'numeric',
                    'max:255',
                ],
            ],
            [
                'name.required' => "Please enter Brand name",
                'vendor_id.required' => "Please enter vendor Name",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('brands'))
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->validated();
        $validated['created_by'] = auth()->user()->email;
        $newBrand = Brand::create($validated);

        return (redirect(route("brands")));
    }

    public function edit(Brand $brand)
    {
        $vendors = Vendor::all();
        return view("dashboard.brands.create", ["brand" => $brand])
            ->with('vendors', $vendors);
    }

    public function update(Brand $brand, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:brands,name,' . $brand->id,
                'vendor_id' => 'required',
            ],
            [
                'name.required' => "Please enter brand name",
                'vendor_id.required' => "Please enter Vendor Name",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('brands.edit', ['brand' => $brand]))
                ->withErrors($validator)
                ->withInput();
        }


        $validated = $validator->validated();
        $brand->update($validated);
        return redirect()->route('brands')->with('success', 'Brand updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $ids = json_decode( $request->selectedIds);
            Brand::destroy($ids);
            return redirect()->route('brands')->with('success', 'Brand deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('brands')->with('error', 'Brand exists in products, cannot delete!');
        }
    }

    // public function import(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'importFile' => 'required|mimes:xlsx,csv,txt|max:2048',
    //         ]);
    //         Excel::import(new BrandsImport, $request->file('importFile'));

    //         return redirect()->route('brand.index')->with('success', 'Import successful!');
    //     } catch (ValidationException $e) {
    //         return redirect(route('brand.index'))
    //             ->withErrors($e->errors())
    //             ->withInput();
    //     } catch (\Exception $e) {
    //         return redirect()
    //             ->route('brand.index')
    //             ->with('error', 'An error occurred during import: ' . $e->getMessage());
    //     }
    // }

    // public function export(Request $request)
    // {
    //     $exportOption = $request->input('exportOption');
    //     if ($exportOption == 'withData') {
    //         return Excel::download(new BrandsExport(true), 'brands_with_data.xlsx');
    //     } elseif ($exportOption == 'withoutData') {
    //         return Excel::download(new BrandsExport(false), 'brands_without_data.xlsx');
    //     }
    // }
}
