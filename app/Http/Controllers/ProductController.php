<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;



class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.products.index')->with('products', $products);
    }

    public function addImage(Request $request)
    {
        $product = Product::find($request->product_id);
        $front_image = $request->file('front_image');
        $back_image = $request->file('back_image');
        $left_image = $request->file('left_image');
        $right_image = $request->file('right_image');
        $style_code = $product->style_code;
        $front_image_name = $style_code . '_front.' . $front_image->getClientOriginalExtension();
        $back_image_name = $style_code . '_back.' . $back_image->getClientOriginalExtension();
        $left_image_name = $style_code . '_left.' . $left_image->getClientOriginalExtension();
        $right_image_name = $style_code . '_right.' . $right_image->getClientOriginalExtension();
        $path = 'product_images/';
        $front_image->move($path, $front_image_name);
        $back_image->move($path, $back_image_name);
        $left_image->move($path, $left_image_name);
        $right_image->move($path, $right_image_name);
        $product->front_image = $front_image_path = $path . $front_image_name;
        $product->back_image = $back_image_path = $path . $back_image_name;
        $product->left_image = $left_image_path = $path . $left_image_name;
        $product->right_image = $right_image_path = $path . $right_image_name;
        $product->save();

        // Create thumbnails and grid images
        $manager = ImageManager::gd();        // Resize and save front images
        $front_thumbnail = $manager->read($front_image_path)->scale(height: 150);
        $front_thumbnail_path = $path . $style_code . '_front_thumbnail.' . $front_image->getClientOriginalExtension();
        $front_thumbnail->save($front_thumbnail_path);

        $front_grid = $manager->read($front_image_path)->scale(height: 150);
        $front_grid_path = $path . $style_code . '_front_grid.' . $front_image->getClientOriginalExtension();
        $front_grid->save($front_grid_path);

        $front_view = $manager->read($front_image_path)->scale(width: 300);
        $front_view_path = $path . $style_code . '_front_view.' . $front_image->getClientOriginalExtension();
        $front_view->save($front_view_path);

        $front_display = $manager->read($front_image_path)->scale(width: 300);
        $front_display_path = $path . $style_code . '_front_display.' . $front_image->getClientOriginalExtension();
        $front_display->save($front_display_path);

        // Resize and save back images
        $back_thumbnail = $manager->read($back_image_path)->scale(height: 150);
        $back_thumbnail_path = $path . $style_code . '_back_thumbnail.' . $back_image->getClientOriginalExtension();
        $back_thumbnail->save($back_thumbnail_path);

        $back_grid = $manager->read($back_image_path)->scale(height: 150);
        $back_grid_path = $path . $style_code . '_back_grid.' . $back_image->getClientOriginalExtension();
        $back_grid->save($back_grid_path);

        $back_view = $manager->read($back_image_path)->scale(width: 300);
        $back_view_path = $path . $style_code . '_back_view.' . $back_image->getClientOriginalExtension();
        $back_view->save($back_view_path);

        $back_display = $manager->read($back_image_path)->scale(width: 300);
        $back_display_path = $path . $style_code . '_back_display.' . $back_image->getClientOriginalExtension();
        $back_display->save($back_display_path);

        // Resize and save left images
        $left_thumbnail = $manager->read($left_image_path)->scale(height: 150);
        $left_thumbnail_path = $path . $style_code . '_left_thumbnail.' . $left_image->getClientOriginalExtension();
        $left_thumbnail->save($left_thumbnail_path);

        $left_grid = $manager->read($left_image_path)->scale(height: 150);
        $left_grid_path = $path . $style_code . '_left_grid.' . $left_image->getClientOriginalExtension();
        $left_grid->save($left_grid_path);

        $left_view = $manager->read($left_image_path)->scale(width: 300);
        $left_view_path = $path . $style_code . '_left_view.' . $left_image->getClientOriginalExtension();
        $left_view->save($left_view_path);

        $left_display = $manager->read($left_image_path)->scale(width: 300);
        $left_display_path = $path . $style_code . '_left_display.' . $left_image->getClientOriginalExtension();
        $left_display->save($left_display_path);

        // Resize and save right images
        $right_thumbnail = $manager->read($right_image_path)->scale(height: 150);
        $right_thumbnail_path = $path . $style_code . '_right_thumbnail.' . $right_image->getClientOriginalExtension();
        $right_thumbnail->save($right_thumbnail_path);

        $right_grid = $manager->read($right_image_path)->scale(height: 150);
        $right_grid_path = $path . $style_code . '_right_grid.' . $right_image->getClientOriginalExtension();
        $right_grid->save($right_grid_path);

        $right_view = $manager->read($right_image_path)->scale(width: 300);
        $right_view_path = $path . $style_code . '_right_view.' . $right_image->getClientOriginalExtension();
        $right_view->save($right_view_path);

        $right_display = $manager->read($right_image_path)->scale(width: 300);
        $right_display_path = $path . $style_code . '_right_display.' . $right_image->getClientOriginalExtension();
        $right_display->save($right_display_path);

        // Save product image details
        $productImage = new ProductImage();
        $productImage->product_id = $request->product_id;
        $productImage->front_thumbnail = $front_thumbnail_path;
        $productImage->front_grid = $front_grid_path;
        $productImage->front_view = $front_view_path;
        $productImage->front_display = $front_display_path;

        $productImage->back_thumbnail = $back_thumbnail_path;
        $productImage->back_grid = $back_grid_path;
        $productImage->back_view = $back_view_path;
        $productImage->back_display = $back_display_path;

        $productImage->left_thumbnail = $left_thumbnail_path;
        $productImage->left_grid = $left_grid_path;
        $productImage->left_view = $left_view_path;
        $productImage->left_display = $left_display_path;

        $productImage->right_thumbnail = $right_thumbnail_path;
        $productImage->right_grid = $right_grid_path;
        $productImage->right_view = $right_view_path;
        $productImage->right_display = $right_display_path;

        $productImage->created_by = auth()->user()->name;
        $productImage->save();

        return redirect()->route('products')->with('success', 'Product image added successfully');
    }

    public function edit(Product $product)
    {
        $vendors = Vendor::all();
        $brandsByVendor = [];
        foreach ($vendors as $vendor) {
            $brandsByVendor[$vendor->id] = Brand::select('name', 'id')
                ->where('vendor_id', $vendor->id)
                ->pluck('name', 'id');
        }
        return view('dashboard.products.edit')
            ->with('product', $product)
            ->with('categories', Category::all())
            ->with('vendors', $vendors)
            ->with('brands', Brand::all())
            ->with('brandsByVendor', $brandsByVendor);
    }

    public function update(Product $product, Request $request)
    {
        try 
        {
            $validate = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'vendor_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'discount_price' => 'required',
            'vendor_style_code' => 'required',
            'style_code' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect(route('products'))
                ->withErrors($validate)
                ->withInput();
        }

        if ($request->input('is_active') == 'on') {
            $is_active= 1;
        } else {
            $is_active = 0;
        }
        $validator = $validate->validated();
        $validator['is_active'] = $is_active;
        $product->update($validator);
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect(route('products'))
            ->with('error', 'Product is being used, cannot update!');
    }

        // // Update product variant
        // $variant = ProductVariant::select('sku')->where('style_code', $product->style_code)->first();
        // $vendorName = Vendor::where('id', $request->input('vendor_id'))->value('name');
        // $brandName = Brand::where('id', $request->input('brand_id'))->value('name');
        // $colour = ProductVariant::where('style_code', $product->style_code)->value('colour');
        // $size = ProductVariant::where('style_code', $product->style_code)->value('size');
        // $sku = strtoupper(substr($vendorName, 0, 2) . substr($brandName, 0, 2) . "-" . $request->input('vendor_style_code') ."-" . $colour . "-" . $size);
        // $variant->sku = $sku;
        // $variant->save();

        return redirect(route('products'))->with('success', 'Product updated successfully');
    }

    public function delete(Request $request)
    {
        try {
            $ids = json_decode($request->selectedIds);
            Product::destroy($ids);
            return redirect()->route('products')
                ->with('success', 'Products deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('products')->with('error', 'Product is being used, cannot delete!');
        }
    }

    public function download(Request $request)
    {
        $downloadType = $request->input('download');
        if ($downloadType == 'WithData') {
            return Excel::download(new ProductExport(true), 'products_with_data.xlsx');
        } elseif ($downloadType == 'WithoutData') {
            return Excel::download(new ProductExport(false), 'products_without_data.xlsx');
        }
    }

    public function upload(Request $request)
    {
        try {
            $this->validate($request, [
                'excelFile' => 'required|mimes:xlsx',
            ]);
            Excel::import(new ProductImport(), $request->file('excelFile'));
            return redirect()->route('products')->with('success', 'Import successful!');
        } catch (ValidationException $e) {
            return redirect(route('products'))
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()
                ->route('products')
                ->with('error', 'An error occurred during import: ' . $e->getMessage());
        }
    }
}
