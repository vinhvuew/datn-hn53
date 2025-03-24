@extends('client.layouts.master')
@section('content')
    <main class="bg-light py-45 d-flex align-items-center"
        style="min-height: 85vh; background: linear-gradient(135deg, #1269ec, #fad0c4);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <div id="confirm" class="bg-white p-5 rounded shadow-lg"
                        style="border: 3px solid #ff6f61; position: relative; overflow: hidden;">
                        <div class="position-absolute top-0 start-0 w-100 h-100"
                            style="background: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png'); opacity: 0.1;">
                        </div>
                        <div class="icon icon--order-success mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100">
                                <g fill="none" stroke="#ff6f61" stroke-width="3">
                                    <circle cx="50" cy="50" r="45" stroke-dasharray="240px, 240px"
                                        stroke-dashoffset="480px"></circle>
                                    <path d="M25,55 L42,70 L75,30" stroke-dasharray="50px, 50px" stroke-dashoffset="0px">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <h2 class="text-danger fw-bold">🎉 Đặt hàng thành công! 🎉</h2>
                        <p class="text-muted fs-5">Cảm ơn bạn đã mua hàng! Bạn sẽ sớm nhận được email xác nhận đơn hàng. 📨
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-danger mt-3 fw-bold px-4 py-2"
                            style="border-radius: 30px; box-shadow: 0 4px 10px rgba(255, 111, 97, 0.5);">🏠 Quay về trang
                            chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
