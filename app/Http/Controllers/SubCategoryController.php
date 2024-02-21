<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.subcategories.index')
        ->with('subcategories', SubCategory::all());
    }

    public function create()
    {
        return view('dashboard.subcategories.create')
        ->with('categories', Category::all());
    }

    public function store(Request $request)
    {
        // Validate the request...
        $validator = Validator::make(request()->all(),
        [
            'name' => 'required|unique:subcategories|max:255',
            'category_id' => 'required',
            'description' => 'text',
        ],
        [
            'name.required' => 'Name is required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name should not exceed 255 characters',
            'category_id.required' => 'Category is required',
            'description.required' => 'Description is required',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->route('subcategories.create')
            ->withErrors($validator)
            ->withInput();
        }

        // Store the record...
        $validated = $validator->validated();
        $validated['created_by'] = auth()->user()->email;
        SubCategory::create($validated);

        return redirect()->route('subcategories')
        ->with('success', 'SubCategory created successfully');
    }

    public function edit(SubCategory $subcategory)
    {
        return view('dashboard.subcategories.create')
        ->with('subcategory', $subcategory)
        ->with('categories', Category::all());
    }

    public function update(SubCategory $subcategory, Request $request)
    {
        // Validate the request...
        $validator = Validator::make(request()->all(),
        [
            'name' => 'required|max:255|unique:subcategories,name,'.$subcategory->id,
            'category_id' => 'required',
            'description' => 'text',
        ],
        [
            'name.required' => 'Name is required',
            'name.unique' => 'Name already exists',
            'name.max' => 'Name should not exceed 255 characters',
            'category_id.required' => 'Category is required',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->route('subcategories.edit',['subcategory' => $subcategory->id])
            ->withErrors($validator)
            ->withInput();
        }

        // Store the record...
        $validated = $validator->validated();
        $subcategory->update($validated);

        return redirect()->route('subcategories')
        ->with('success', 'SubCategory updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $ids = json_decode( $request->selectedIds);
            SubCategory::destroy($ids);
            return redirect()->route('subcategories')
            ->with('success', 'SubCategory deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('subcategories')
            ->with('error', 'SubCategory cannot be deleted');
        }
    }
}
