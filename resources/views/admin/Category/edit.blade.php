@extends('admin.master')
@section('title')
    Sửa dan mục
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

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chỉnh Sửa Danh Mục</h4>
            </div>
    
            <form action="{{ route('admin.category.update', $category['slug']) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Tên danh mục:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category['name'] }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Quay Lại</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
    



@endsection
