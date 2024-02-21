<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\TopSelling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopSellingController extends Controller
{
    public function index()
    {
        $topSellings = TopSelling::all();
        return view('dashboard.topSelling.index')
            ->with('topSellings', $topSellings);
    }

    public function create()
    {
        $products = Product::select('style_code')->get();
        return view('dashboard.topSelling.create')
            ->with('products', $products);
    }

    public function store(Request $request)
    {
        foreach ($request->style_code as $styleCode) {
            $validator = Validator::make(
                [
                    'style_code' => $styleCode,
                ],
                [
                    'style_code' => 'required',
                ],
                [
                    'style_code.required' => 'The style code field is required for ' . $styleCode . '.',
                ]
            );

            if ($validator->fails()) {
                return redirect()->route('topSelling.create')
                    ->withErrors($validator)
                    ->withInput();
            }
            $validated = $validator->validated();
            $validated['created_by'] = auth()->user()->email;
            TopSelling::updateOrCreate(
                ['style_code' => $styleCode],
                $validated
            );
        }
        return redirect()->route('topSelling')
            ->with('success', 'Top selling added successfully.');
    }

    public function delete(Request $request)
    {
        $ids = json_decode($request->selectedIds);
        TopSelling::destroy($ids);
        return redirect()->route('topSelling')
            ->with('success', 'Top selling deleted successfully.');
    }
}
