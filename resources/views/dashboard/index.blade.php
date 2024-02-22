@extends('dashboard.layouts.admin_panel_view')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php $count_users = \App\Models\User::count(); ?>
                <div class="clearfix hidden-md-up"></div>
                <?php $count_product = \App\Models\Product::count(); ?>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Products</span>
                            <span class="info-box-number">
                                {{ $count_product }}
                            </span>
                        </div>
                    </div>
                </div>
                @php
                    $count_categories = \App\Models\Category::count();
                @endphp
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th-large"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Categories</span>
                            <span class="info-box-number">
                                {{ $count_categories }}
                            </span>
                        </div>
                    </div>
                </div>
                @php
                    $count_brands = \App\Models\Brand::count();
                @endphp
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Brands</span>
                            <span class="info-box-number">
                                {{ $count_brands }}
                            </span>
                        </div>
                    </div>
                </div>
                @php
                    $count_vendors = \App\Models\Vendor::count();
                @endphp
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Vendors</span>
                            <span class="info-box-number">
                                {{ $count_vendors }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recently Added Products</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach ($products as $prods)
                                        <li class="item">
                                            <div class="product-img">
                                                <img src="{{ $prods->front_image }}"
                                                    class="img-size-50">
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ $prods->slug }}" class="product-title">{{ $prods->name }}
                                                    @if ($prods->is_active == 1)
                                                        <span class="badge badge-success float-right">Active</span>
                                                    @else
                                                        <span class="badge badge-danger float-right">Inactive</span>
                                                    @endif
                                                </a>
                                                <span class="product-description"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="/dashboard/products" class="uppercase">View All Products</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
