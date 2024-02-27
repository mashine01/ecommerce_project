<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.index')
            ->with('products', $products);
    }
}
