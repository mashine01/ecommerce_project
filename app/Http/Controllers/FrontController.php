<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Models\TopSelling;
use App\Models\Trending;
use App\Models\TrendingCategory;
use Illuminate\Http\Request;
use Spatie\Color\Hex;

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

    public function category(Request $request)
    {    
        $category = $request->category;
        $subcategory = $request->subcategory;        
        $subcategoryName = SubCategory::where('id', $subcategory)->value('name');
        $categoryName = Category::where('id', $category)->value('name');
        $colours = ProductVariant::pluck('colour')->unique();
        $sizes = ProductVariant::pluck('size')->unique();
        $brands = Brand::all()->unique('name');
        $products = Product::where('sub_category_id', $subcategory)->paginate(9);

        if ($request->ajax()) {
            // Retrieve filter parameters from the request
            $brands = $request->input('data');

            // Query products based on the filters
            $query = Product::query();
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }

            $filteredProducts = $query->paginate(9);
            return response()->json(['products' => $filteredProducts]);
        }

        return view('front.category')
            ->with('products', $products)
            ->with('brands', $brands)
            ->with('colours', $colours)
            ->with('sizes', $sizes)
            ->with('categoryName', $categoryName)
            ->with('subcategoryName', $subcategoryName)
            ->with('category', $category)
            ->with('subcategory', $subcategory);
    }
}
