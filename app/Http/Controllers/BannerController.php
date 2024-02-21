<?php

namespace App\Http\Controllers;

use App\Exports\BannersExport;
use App\Imports\BannersImport;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('dashboard.banners.index')->with("banners", $banners);
    }

    public function create()
    {
        $banners = Banner::all();
        return view('dashboard.banners.create')
            ->with('banners', $banners);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'banner_title' => 'required|string|max:255',
                'banner_subtitle' => 'required|string|max:255',
                'banner_type' => 'required',
                'priority' => 'required|integer',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'banner_title.required' => "Please enter banner name",
                'banner_type.required' => "Please select banner type",
                'priority.required' => "Please enter banner priority",
                'priority.integer' => "Banner priority must be an integer",
                'image.required' => "Please upload an image",
                'image.image' => "Invalid image format",
                'image.mimes' => "Invalid image format. Only JPEG, PNG, JPG, and GIF formats are allowed",
                'image.max' => "Image size exceeds the maximum limit of 2MB",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('banners.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $path = 'banners_images/';
        $image->move($path, $imageName);
        $validated = $validator->validated();
        $validated['created_by'] = auth()->user()->email;
        $validated['banner_path'] = $path . $imageName;
        $newBanner = Banner::create($validated);

        return redirect(route("banners"))->with('success', 'Banner created successfully');
    }

    public function edit(Banner $banner)
    {
        return view("dashboard.banners.create", ["banner" => $banner]);
    }

    public function update(Banner $banner, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'banner_title' => 'required|string|max:255',
                'banner_subtitle' => 'required|string|max:255',
                'banner_type' => 'required',
                'priority' => 'required|integer',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'banner_title.required' => "Please enter the banner name",
                'banner_title.string' => "The banner name must be a string",
                'banner_title.max' => "The banner name must not exceed 255 characters",
                'banner_subtitle.required' => "Please enter the banner subtitle",
                'banner_subtitle.string' => "The banner subtitle must be a string",
                'banner_subtitle.max' => "The banner subtitle must not exceed 255 characters",
                'banner_type.required' => "Please select the banner type",
                'priority.required' => "Please enter the banner priority",
                'priority.integer' => "The banner priority must be an integer",
                'image.image' => "Invalid image format",
                'image.mimes' => "Invalid image format. Only JPEG, PNG, JPG, and GIF formats are allowed",
                'image.max' => "Image size exceeds the maximum limit of 2MB",
            ]
        );

        if ($validator->fails()) {
            return redirect(route('banners.edit', ['banner' => $banner]))
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $path = 'banners_images/';
            $image->move($path, $imageName);
            $validated['banner_path'] = $path . $imageName;
        }
        $banner->update($validated);
        return redirect()->route('banners')->with('success', 'Banner updated successfully');
    }

    public function delete(Request $request)
    {
        $ids = json_decode($request->selectedIds);
        Banner::destroy($ids);
        return redirect()->route('banners')->with('success', 'Banner(s) deleted successfully');
    }
}
