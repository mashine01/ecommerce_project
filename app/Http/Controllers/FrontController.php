<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductVariant;
use App\Models\TopSelling;
use App\Models\Trending;
use App\Models\TrendingCategory;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        $trendingsCategories = TrendingCategory::all();
        $trendings = Trending::all();
        $topSellings = TopSelling::all();
        $categories = Category::all();
        return view('index')
        ->with('banners', $banners)
        ->with('categories', $categories)
        ->with('trendingsCategories', $trendingsCategories)
        ->with('topSellings', $topSellings)
        ->with('trendings', $trendings);
    }

    public function blog()
    {
        return view('blog');
    }
}
