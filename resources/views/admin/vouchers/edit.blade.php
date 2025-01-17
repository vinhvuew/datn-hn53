@extends('admin.layouts.master')
@section('content')
<h1>Edit Voucher</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="voucher">Voucher Code</label>
        <input type="text" name="voucher" id="voucher" class="form-control" value="{{ old('voucher', $voucher->voucher) }}" required>
    </div>
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $voucher->name) }}" required>
    </div>
    
    <div class="form-group">
        <label for="valid_from">Valid From</label>
        <input type="date" name="valid_from" id="valid_from" class="form-control" value="{{ old('valid_from', $voucher->valid_from) }}" required>
    </div>
    
    <div class="form-group">
        <label for="valid_to">Valid To</label>
        <input type="date" name="valid_to" id="valid_to" class="form-control" value="{{ old('valid_to', $voucher->valid_to) }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
@section('style-libs')
@endsection
@section('script-libs')

@endsection