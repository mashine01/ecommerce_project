<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Trending;
use App\Models\TrendingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrendingController extends Controller
{
    public function index()
    {
        $trendings = Trending::all();
        return view('dashboard.trendings.index')
            ->with('trendings', $trendings);
    }

    public function create()
    {
        $products = Product::all();
        $trendingCategories = TrendingCategory::all();
        return view('dashboard.trendings.create')
            ->with('products', $products)
            ->with('trendingCategories', $trendingCategories);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'style_code' => [
                    'required',
                    'array',
                ],
                'trending_category' => [
                    'required',
                    'array',
                ],
            ],
            [
                'style_code.required' => "Please select product",
                'trending_category.required' => "Please select trending category",
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('trendings.create')
                ->withErrors($validator)
                ->withInput();
        }

        $styleCodes = $request->input('style_code');
        $trendingCategories = $request->input('trending_category');

        foreach ($styleCodes as $styleCode) {
            foreach ($trendingCategories as $category) {
                Trending::updateOrCreate(
                    ['style_code' => $styleCode],
                    [
                        'categories' => $category,
                        'created_by' => auth()->user()->name,
                    ]
                );
            }
        }

        return redirect()->route('trendings')
            ->with('success', 'Trending added successfully.');
    }

    public function delete(Request $request)
    {
        $ids = json_decode($request->selectedIds);
        Trending::destroy($ids);
        return redirect()->route('trendings')
            ->with('success', 'Trending deleted successfully.');
    }
}
