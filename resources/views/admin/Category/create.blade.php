@extends('admin.master')
@section('title')
    Thêm danh mục
@endsection
@section('content')
    <section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thêm Danh Mục Mới</h4>
        </div>

        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Tên danh mục:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Thêm Mới</button>
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Quay Lại</a>
                </div>
            </div>
        </form>
    </div>
</section>

    
    



@endsection
