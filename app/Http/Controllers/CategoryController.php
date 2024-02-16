<?php

namespace App\Http\Controllers;

use App\Exports\CategoriesExport;
use App\Imports\CategoriesImport;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index')->with("categories", $categories);
    }

    public function create()
    {
        return view('dashboard.categories.create');
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
                    'unique:categories,name,',
                ],
            ],
            [
                'name.required' => "Please enter category name",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('categories'))
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $validated['created_by'] = auth()->user()->email;
        $validated['show_on_menu'] = $request->input('show_on_menu') ? true : false;
        $newVendor = Category::create($validated);
        return (redirect(route("categories")));
    }

    public function edit(Category $category)
    {
        return view("dashboard.categories.edit", ["category" => $category]);
    }

    public function update(Category $category, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories,name,' . $category->id,
            ],
            [
                'name.required' => "Please enter category name",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('category.edit', ['category' => $category]))
                ->withErrors($validator)
                ->withInput();
        }


        $validated = $validator->validated();
        $validated['show_on_menu'] = $request->input('show_on_menu') ? true : false;
        $category->update($validated);
        return redirect()->route('categories')->with('success', 'Category updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $ids = json_decode($request->selectedIds);
            Category::destroy($ids);
            return redirect()->route('categories')->with('success', 'Category deleted successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categories')->with('error', 'Category exists in products, cannot delete!');
        }
    }

    // public function export(Request $request) {
    //     $exportOption = $request->input('exportOption');
    //     if ($exportOption === 'withData'){
    //         return Excel::download(new CategoriesExport(true), 'categories_with_data.xlsx');
    //     } else if ($exportOption === 'withoutData'){
    //         return Excel::download(new CategoriesExport(false), 'categories_without_data.xlsx');
    //     }
    // }

    // public function import(Request $request) {
    //     try {
    //         $this->validate($request, [
    //             'importFile' => 'required|mimes:xlsx',
    //         ]);
    //         Excel::import(new CategoriesImport(), $request->file('importFile'));
    //         return redirect()->route('category.index')->with('success', 'Import successful!');
    //     } catch (ValidationException $e) {
    //         return redirect(route('category.index'))
    //             ->withErrors($e->errors())
    //             ->withInput();
    //     } catch (\Exception $e) {
    //         return redirect()
    //         ->route('category.index')
    //         ->with('error', 'An error occurred during import: ' . $e->getMessage());
    //     }
    // }

}
