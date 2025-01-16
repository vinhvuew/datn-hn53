@extends('admin.layouts.master')
@section('content')
<form action="{{ route('voucher.store') }}" method="POST">
  @csrf
  <div class="form-group">
      <label for="voucher">Voucher Code:</label>
      <input type="text" class="form-control" id="voucher" name="voucher" value="{{ old('voucher') }}" required>
  </div>

  <div class="form-group">
      <label for="name">Voucher Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
  </div>

  <div class="form-group">
      <label for="valid_from">Valid From:</label>
      <input type="date" class="form-control" id="valid_from" name="valid_from" value="{{ old('valid_from') }}" required>
  </div>

  <div class="form-group">
      <label for="valid_to">Valid To:</label>
      <input type="date" class="form-control" id="valid_to" name="valid_to" value="{{ old('valid_to') }}" required>
  </div>

  <button type="submit" class="btn btn-primary">Add Voucher</button>
</form>

@endsection
@section('style-libs')
@endsection
@section('script-libs')

@endsection
