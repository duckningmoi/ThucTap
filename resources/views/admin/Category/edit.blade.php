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
    <form action="{{route('admin.categoriesAdmin.update', $cate->id)}}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="form-group">
            <label for="name">Tên Film:</label>
            <input type="text" class="form-control" id="name" name="name_cate" value="{{$cate->name_cate}}">
            @error('name_film')
                <div>{{ $message }}</div>
            @enderror
        </div>
            <button type="submit">Update</button>
    </form>
</div>



@endsection