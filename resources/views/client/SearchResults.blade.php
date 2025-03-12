@extends('client.layouts.master')
@section('content')
<main>
         <div class="container margin_60_35">
             <div class="main_title">
                 <h2>Kết quả tìm kiếm</h2>
                 <span>Sản phẩm phù hợp</span>
                 <p>Hiển thị các sản phẩm bạn đang tìm kiếm.</p>
             </div>

             <div class="row small-gutters">
                 @if($searchResults->isNotEmpty())
                     @foreach($searchResults as $product)
                         <div class="col-6 col-md-4 col-xl-3">
                             <div class="grid_item">
                                 <figure>
                                     <img src="{{ Storage::url($product->img_thumbnail) }}"
                                         width="300px" alt="{{ $product->name }}">
                                 </figure>
                                 <h3>{{ $product->name }}</h3>
                                 <div class="price_box">
                                     <span class="old_price">{{ number_format($product->base_price) }}đ</span>

                                     @if ($product->price_sale)
                                         <span class="new_price">{{ number_format($product->price_sale) }}đ</span>
                                     @endif
                                 </div>
                                 <ul>
                                     <li>
                                         <a href="#" class="tooltip-1" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Thêm vào so sánh">
                                            <i class="ti-control-shuffle"></i><span>So sánh</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#" class="tooltip-1" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="Thêm vào giỏ hàng">
                                            <i class="ti-shopping-cart"></i><span>Thêm giỏ hàng</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     @endforeach
                 @else
                     <div class="col-12 text-center">
                         <h4 class="text-danger">Sản phẩm không tồn tại</h4>
                         <p>Vui lòng thử lại với từ khóa khác.</p>
                     </div>
                     @endif
             </div>

         </div>
         </main>
     <!-- /main -->

 @endsection
