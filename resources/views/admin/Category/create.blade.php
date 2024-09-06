@extends('admin.masterAdmin')
@section('title')
Thêm Mới Sản Phẩm
@endsection
@section('content')
@if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row">
    <form action="{{route('admin.productsAdmin.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên Film:</label>
            <input type="text" class="form-control" id="name" name="name_film">
            @error('name_film')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="publish_year">Năm Xuất Bản:</label>
            <input type="text" class="form-control" id="publish_year" name="publish_year">
        </div>
        <div class="form-group">
            <label for="description">Thể Loại</label>:</label>
            <select name="category_id" id="">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name_cate}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Ảnh Film:</label>
            <input type="file" class="form-control-file" id="image"  name="image">
            <button type="submit">Create</button>
    </form>
</div>



@endsection