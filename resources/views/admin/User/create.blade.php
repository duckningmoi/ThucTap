<div>
    <!-- He who is contented is rich. - Laozi -->
</div>
@extends('admin.master')
@section('title')
Thêm bài viết
@endsection
@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thêm Người Dùng Mới</h4>
        </div>

        <form class="container" action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="name" placeholder="Tên người dùng" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Nhập lại Mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Xác nhận mật khẩu" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">Tạo Mới</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

@section('js')
<script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-image');
        const imageFieldsContainer = document.getElementById('image-fields');
        let imageCount = 1;

        addButton.addEventListener('click', function() {
            imageCount++;
            const newField = document.createElement('div');
            newField.classList.add('mb-3');
            newField.innerHTML = `
                <label for="formFile${imageCount}" class="form-label">Ảnh thêm bài viết ${imageCount}</label>
                <i class="bi bi-trash remove-image" data-index="${imageCount}"></i>
                <input class="form-control" type="file" id="formFile${imageCount}" name="images[]">
                <br>
                <input type="text" name="tieude[]" placeholder="tiêu đề ảnh">
            `;
            imageFieldsContainer.appendChild(newField);
        });

        // Xử lý sự kiện xóa
        imageFieldsContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-image')) {
                event.target.parentElement.remove();
            }
        });
    });
</script>
@endsection