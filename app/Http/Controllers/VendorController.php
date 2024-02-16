<?php

namespace App\Http\Controllers;

use App\Exports\VendorsExport;
use App\Imports\VendorsImport;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;


class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::all();
        return view('dashboard.vendors.index')->with("vendors", $vendors);
    }

    public function create()
    {
        return view('dashboard.vendors.create');
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
                    'unique:vendors,name'
                ],
            ],
            [
                'name.required' => "Please enter vendor name",
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $validated['created_by'] = auth()->user()->email;
        $newVendor = Vendor::create($validated);

        return (redirect(route("vendors")));
    }

    public function edit(Vendor $vendor)
    {
        return view("dashboard.vendors.create", ["vendor" => $vendor]);
    }

    public function update(Vendor $vendor, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:vendors,name,' . $vendor->id,
            ],
            [
                'name.required' => "Please enter vendor name",
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $vendor->update($validated);
        return redirect()->route('vendors')->with('success', 'Vendor updated successfully');
    }

    public function delete(Request $request)
    {
        try{
            $ids = json_decode($request->selectedIds);
            Vendor::destroy($ids);
            return redirect()->route('vendors')
            ->with('success', 'Vendors deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Vendors exists in brands, cannot delete!');
        }
    }

    // public function import(Request $request)
    // {
    //     try {
    //         $this->validate($request, [
    //             'importFile' => 'required|mimes:xlsx,csv,txt|max:2048',
    //         ]);
    //         Excel::import(new VendorsImport, $request->file('importFile'));

    //         return redirect()->route('vendor.index')->with('success', 'Import successful!');
    //     } catch (ValidationException $e) {
    //         return redirect(route('vendor.index'))
    //             ->withErrors($e->errors())
    //             ->withInput();
    //     } catch (\Exception $e) {
    //         return redirect()
    //             ->route('vendor.index')
    //             ->with('error', 'An error occurred during import: ' . $e->getMessage());
    //     }
    // }

    // public function export(Request $request)
    // {
    //     $exportOption = $request->input('exportOption');
    //     if ($exportOption == 'withData') {
    //         return Excel::download(new VendorsExport(true), 'vendors_with_data.xlsx');
    //     } elseif ($exportOption == 'withoutData') {
    //         return Excel::download(new VendorsExport(false), 'vendors_without_data.xlsx');
    //     }
    // }
}
