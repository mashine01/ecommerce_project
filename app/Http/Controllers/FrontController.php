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
        $categoryName = Category::where('id', $category)->value('name');
        $colours = ProductVariant::join('products', 'product_variants.style_code', '=', 'products.style_code')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where('categories.name', $categoryName)
            ->select('product_variants.colour')
            ->distinct()
            ->get()
            ->pluck('colour');
        $sizes = ProductVariant::join('products', 'product_variants.style_code', '=', 'products.style_code')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where('categories.name', $categoryName)
            ->select('product_variants.size')
            ->distinct()
            ->get()
            ->pluck('size');
        $brands = Brand::join('products', 'brands.id', '=', 'products.brand_id')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where('categories.name', $categoryName)
            ->select('brands.*')
            ->distinct()
            ->get();
        $products = Product::select('products.*')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->join('categories', 'subcategories.category_id', '=', 'categories.id')
            ->where('categories.name', $categoryName)
            ->get();

        $minPrice = $products->min('price');
        $maxPrice = $products->max('price');
        $prices = [];
        for ($i = $minPrice; $i < $maxPrice; $i += 20.0) {
            $prices[] = [
                'min' => floatval($i),
                'max' => min(floatval($i + 20.0), floatval($maxPrice)),
            ];
        }

        // If the request is an AJAX request, return the filtered products
        if ($request->ajax()) {
            // Retrieve filter parameters from the request
            $brands = $request->input('brands');
            $prices = $request->input('prices');
            $sizes = $request->input('sizes');
            $colours = $request->input('colours');
            $sortBy = $request->input('sortBy');

            // Query products based on the filters
            $query = Product::query();

            $query->whereHas('subcategory.category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            });
            
            // If the brands are not empty, filter the products based on the brands
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }

            // If the prices are not empty, filter the products based on the price ranges
            if (!empty($prices)) {
                $priceRanges = [];

                // Convert the price ranges to an array of min and max values
                foreach ($prices as $price) {
                    $range = explode(',', $price[0]);
                    $priceRanges[] = [
                        'min' => floatval($range[0]),
                        'max' => floatval($range[1]),
                    ];
                }

                // Query products based on the price ranges
                foreach ($priceRanges as $index => $range) {
                    if ($index === 0) {
                        $query->whereBetween('price', [$range['min'], $range['max']]);
                    } else {
                        $query->orWhereBetween('price', [$range['min'], $range['max']]);
                    }
                }
            }

            if (!empty($sizes)) {
                $query->whereHas('variants', function ($query) use ($sizes) {
                    $query->whereIn('size', $sizes);
                });
            }

            if (!empty($colours)) {
                $query->whereHas('variants', function ($query) use ($colours) {
                    $query->whereIn('colour', $colours);
                });
            }

            if (!empty($sortBy)) {
                if ($sortBy === 'popularity') {
                    $query->orderBy('created_at', 'asc');
                } elseif ($sortBy === 'rating') {
                    $query->orderBy('created_at', 'desc');
                }
            }


            // Retrieve the filtered products
            $filteredProducts = $query->with('subcategory.category')->get();

            return response()->json(['products' => $filteredProducts]);
        }

        return view('front.category')
            ->with('products', $products)
            ->with('brands', $brands)
            ->with('colours', $colours)
            ->with('sizes', $sizes)
            ->with('categoryName', $categoryName)
            ->with('category', $category)
            ->with('priceRanges', $prices)
            ->with('minPrice', $minPrice)
            ->with('maxPrice', $maxPrice);
    }

    public function subcategory(Request $request)
    {
        $category = $request->category;
        $subcategory = $request->subcategory;
        $subcategoryName = SubCategory::where('id', $subcategory)->value('name');
        $categoryName = Category::where('id', $category)->value('name');
        $colours = ProductVariant::join('products', 'product_variants.style_code', '=', 'products.style_code')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->where('subcategories.name', $subcategoryName)
            ->select('product_variants.colour')
            ->distinct()
            ->get()
            ->pluck('colour');
        $sizes = ProductVariant::join('products', 'product_variants.style_code', '=', 'products.style_code')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->where('subcategories.name', $subcategoryName)
            ->select('product_variants.size')
            ->distinct()
            ->get()
            ->pluck('size');
        $brands = Brand::join('products', 'brands.id', '=', 'products.brand_id')
            ->join('subcategories', 'products.sub_category_id', '=', 'subcategories.id')
            ->where('subcategories.name', $subcategoryName)
            ->select('brands.*')
            ->distinct()
            ->get();
        $products = Product::where('sub_category_id', $subcategory)->get();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');
        $prices = [];
        for ($i = $minPrice; $i < $maxPrice; $i += 20.0) {
            $prices[] = [
                'min' => floatval($i),
                'max' => min(floatval($i + 20.0), floatval($maxPrice)),
            ];
        }

        // If the request is an AJAX request, return the filtered products
        if ($request->ajax()) {
            // Retrieve filter parameters from the request
            $brands = $request->input('brands');
            $prices = $request->input('prices');
            $sizes = $request->input('sizes');
            $colours = $request->input('colours');
            $sortBy = $request->input('sortBy');

            // Query products based on the filters
            $query = Product::query();

            // If the brands are not empty, filter the products based on the brands
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }

            // If the prices are not empty, filter the products based on the price ranges
            if (!empty($prices)) {
                $priceRanges = [];

                // Convert the price ranges to an array of min and max values
                foreach ($prices as $price) {
                    $range = explode(',', $price[0]);
                    $priceRanges[] = [
                        'min' => floatval($range[0]),
                        'max' => floatval($range[1]),
                    ];
                }

                // Query products based on the price ranges
                foreach ($priceRanges as $index => $range) {
                    if ($index === 0) {
                        $query->whereBetween('price', [$range['min'], $range['max']]);
                    } else {
                        $query->orWhereBetween('price', [$range['min'], $range['max']]);
                    }
                }
            }

            if (!empty($sizes)) {
                $query->whereHas('variants', function ($query) use ($sizes) {
                    $query->whereIn('size', $sizes);
                });
            }

            if (!empty($colours)) {
                $query->whereHas('variants', function ($query) use ($colours) {
                    $query->whereIn('colour', $colours);
                });
            }

            if (!empty($sortBy)) {
                if ($sortBy === 'popularity') {
                    $query->orderBy('created_at', 'asc');
                } elseif ($sortBy === 'rating') {
                    $query->orderBy('created_at', 'desc');
                }
            }

            // Retrieve the filtered products
            $filteredProducts = $query->with('subcategory.category')->get();

            return response()->json(['products' => $filteredProducts]);
        }

        return view('front.subcategory')
            ->with('products', $products)
            ->with('brands', $brands)
            ->with('colours', $colours)
            ->with('sizes', $sizes)
            ->with('categoryName', $categoryName)
            ->with('subcategoryName', $subcategoryName)
            ->with('category', $category)
            ->with('subcategory', $subcategory)
            ->with('priceRanges', $prices)
            ->with('minPrice', $minPrice)
            ->with('maxPrice', $maxPrice);
    }
}
