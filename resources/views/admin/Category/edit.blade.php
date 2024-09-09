@extends('admin.master')
@section('title')
    Sửa Sản Phẩm
@endsection
@section('content')
    {{-- @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row">
        <form action="{{ route('admin.category.update',$category['slug']) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="name">Tên danh mục:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category['name'] }}">
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Update</button>
        </form>
    </div>



@endsection
