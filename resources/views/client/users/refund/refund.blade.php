@extends('client.layouts.master')

@section('content')
    <main>
        <div class="content-wrapper" style="padding: 1px 0 250px;">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h3 class="text-center mb-4">Yêu cầu trả hàng hàng / Hoàn tiền</h3>
                <form action="{{ route('profile.refundRequests') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-md-12">
                        <table class="datatables-order-details table">
                            <thead>
                                <tr>
                                    <th class="w-50">Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                    @if ($item->product)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="avatar me-2 pe-1">
                                                        @if ($item->product->img_thumbnail)
                                                            <img src="{{ Storage::url($item->product->img_thumbnail) }}"
                                                                width="50px" alt="">
                                                        @else
                                                            <img src="{{ asset('images/default-thumbnail.png') }}"
                                                                width="50px" alt="Default Image">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span>{{ $item->product_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_price, 0, ',', '.') }} VND</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center mb-1">
                                                    <div class="avatar me-2 pe-1">
                                                        @if ($item->variant && $item->variant->product->img_thumbnail)
                                                            <img class="rounded-2"
                                                                src="{{ Storage::url($item->variant->product->img_thumbnail) }}"
                                                                width="50px" alt="">
                                                        @else
                                                            <img src="{{ asset('images/default-thumbnail.png') }}"
                                                                width="50px" alt="Default Image">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <span>{{ $item->product_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @php
                                                    $attributes = explode(' - ', $item->variant_attribute);
                                                    $values = explode(' - ', $item->variant_value);
                                                @endphp
                                                <span class="block text-sm text-gray-700">
                                                    @foreach ($attributes as $index => $attribute)
                                                        {{ $attribute }}: {{ $values[$index] ?? '' }}
                                                        @if (!$loop->last)
                                                            |
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </td>
                                            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->total_price, 0, ',', '.') }} VND</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">


                        <div class="col-12 col-md-6">
                            <label for="reason" class="mb-1 mt-2">Lý do</label>
                            <select class="form-select" name="reason">
                                <option selected disabled>Lý do hoàn tiền</option>
                                <option value="Thiếu hàng">Thiếu hàng</option>
                                <option value="Hàng lỗi">Hàng lỗi</option>
                                <option value="Khác với mô tả">Khác với mô tả</option>
                            </select>
                        </div>
                        @error('reason')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12 col-md-6">
                            <label for="total_amount" class="mb-1 mt-2">Số tiền hoàn lại</label>
                            <input type="text" class="form-control"
                                value="{{ number_format($item->order->total_price, 0, ',', '.') }} VNĐ" disabled>
                            <input type="hidden" name="total_amount" value="{{ $item->order->total_price }}">
                        </div>
                        @error('total_amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12 col-md-12">
                            <label for="refund_on" class="mb-1 mt-2">Hoàn tiền vào ( Ngân Hàng/STK/Chủ Tài Khoản )</label>
                            <input type="text" name="refund_on" class="form-control"
                                placeholder="VÍ DỤ: MBBANK/0345961416/LÝ TRUNG ĐỨC" value="{{ old('refund_on') }}" />
                        </div>
                        @error('refund_on')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12 col-md-12">
                            <label for="note" class="mb-1 mt-2">Mô tả</label>
                            <textarea name="note" cols="30" rows="1" class="form-control" placeholder="Lý do chi tiết"></textarea>
                        </div>
                        @error('note')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12 col-md-6">
                            <label for="note" class="mb-1 mt-2">Ảnh chứng minh</label>
                            <input type="file" name="proveRufund[image][]" class="form-control" multiple />
                        </div>
                        @if ($errors->has('proveRufund.image.*'))
                            <div class="text-danger">
                                @foreach ($errors->get('proveRufund.image.*') as $messages)
                                    @foreach ($messages as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                        <div class="col-12 col-md-6">
                            <label for="note" class="mb-1 mt-2">Video chứng minh</label>
                            <input type="file" name="proveRufund[video][]" class="form-control" multiple />
                        </div>
                        @if ($errors->has('proveRufund.video.*'))
                            <div class="text-danger">
                                @foreach ($errors->get('proveRufund.video.*') as $messages)
                                    @foreach ($messages as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                        <div class="col-12 col-md-12">
                            <label for="Email" class="mb-1 mt-2">Email</label>
                            <input type="email"name="email" class="form-control" placeholder="Email"
                                value="{{ $item->order->user->email }}" />
                        </div>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12 text-center mt-3">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi Yêu Cầu</button>
                            <a href="{{ route('profile.detailOrder', $order->id) }}" class="btn btn-outline-secondary">Hủy
                                bỏ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/pages/page-profile.css" />
    <style>
        a {
            color: #4C5671;
        }

        .rts-header__menu ul li a {
            color: #000000;
        }

        .rts-header__right .login__btn {
            border: 1px solid #000000;
            color: #000000;
        }

        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus {
            background-color: #9055fd;
            color: #fff;
        }
    </style>
@endsection
