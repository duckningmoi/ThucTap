@extends('admin.masterAdmin')
@section('title')
Chi Tiết Sản Phẩm
@endsection
@section('content')
<div class="row">
    <ul>
        <li>ID: {{ $product->id }}</li>
        <li>Name Film: {{ $product->name_film }}</li>
        <li>Publish Year: {{ $product->publish_year }}</li>
        <li>Category ID: {{ $product->category_id }}</li>
        <li>Category Name: {{ $product->name_cate }}</li>
        <li>Image: <img src=" {{ asset($product->image) }}" alt="Product Image"></li>
        <li>Created At: {{ $product->created_at }}</li>
        <li>Updated At: {{ $product->updated_at }}</li>
    </ul>
</div>
@endsection