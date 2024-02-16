<?php

namespace App\Http\Controllers;

use App\Models\Banner;
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
    private $categories;
    private $subCategories;

    public function __construct()
    {
        $this->categories = Category::all();
        $this->subCategories = SubCategory::all();
    }

    public function index()
    {
        $banners = Banner::all();
        $trendingsCategories = TrendingCategory::all();
        $trendings = Trending::all();
        $topSellings = TopSelling::all();

        return view('index')
            ->with('banners', $banners)
            ->with('categories', $this->categories)
            ->with('subCategories', $this->subCategories)
            ->with('trendingsCategories', $trendingsCategories)
            ->with('topSellings', $topSellings)
            ->with('trendings', $trendings);
    }

    public function header() {
        return view('dashboard.layout.header')
            ->with('categories', $this->categories)
            ->with('subCategories', $this->subCategories);
    }

    public function blog()
    {
        return view('blog');
    }

    public function account(){
        return view('front.account.dashboard');
    }
}
