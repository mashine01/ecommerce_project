<?php

namespace App\Http\Controllers;

use App\Models\TrendingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrendingCategoryController extends Controller
{
    public function index()
    {
        $trendingCategory = trendingCategory::all();
        return view('dashboard.trendingCategory.index')
        ->with('trendingCategory', $trendingCategory);
    }

    public function create()
    {
        return view('dashboard.trendingCategory.create');
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
                    'unique:trending_categories,name,',
                ],
            ],
            [
                'name.required' => "Please enter Trending Category name",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('trendingCategory'))
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $validated['created_by'] = auth()->user()->email;
        $trendingCategory = TrendingCategory::create($validated);
        return redirect(route('trendingCategory'))->with('success', 'Trending Category created successfully');
    }

    public function edit(TrendingCategory $category)
    {
        return view("dashboard.trendingCategory.edit", ['category' => $category]);
    }

    public function update(TrendingCategory $category, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:trending_categories,name,' . $category->id,
                ],
            ],
            [
                'name.required' => "Please enter Trending Category name",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('trendingCategory'))
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $category->update($validated);
        return redirect(route('trendingCategory'))->with('success', 'Trending Category updated successfully');
    }

    public function delete(Request $request)
    {
        $ids = json_decode($request->selectedIds);
        TrendingCategory::destroy($ids);
        return redirect(route('trendingCategory'))->with('success', 'Trending Category deleted successfully');
    }
}
