<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Models\TopSelling;
use App\Models\Trending;
use App\Models\TrendingCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{

    public function index()
    {
        $banners = Banner::all();
        $trendingsCategories = TrendingCategory::all();
        $trendings = Trending::all();
        $topSellings = TopSelling::all();
        $brands = Brand::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();

        // Retrieve counts of related products for each trending category
        $categoryProductCounts = TrendingCategory::withCount('trendings')->pluck('trendings_count', 'name');

        return view('front.index')
            ->with('banners', $banners)
            ->with('categories', $categories)
            ->with('subCategories', $subCategories)
            ->with('trendingsCategories', $trendingsCategories)
            ->with('topSellings', $topSellings)
            ->with('trendings', $trendings)
            ->with('brands', $brands);
    }

    public function blog()
    {
        return view('blog');
    }

    public function account()
    {
        return view('front.account.dashboard');
    }
}
