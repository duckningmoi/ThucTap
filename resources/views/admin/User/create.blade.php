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
        </div>

        <form class="container" action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Tên người dùng</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="tên người dùng" name="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> <br>


                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        <input type="email" class="w-50 form-control" id="basicInput" placeholder="email" name="email">
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> <br>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Password</label>
                        <input type="password" class="form-control" id="basicInput" placeholder="password" name="password">
                    </div>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="basicInput">Nhập lại Password </label>
                        <input type="password" class="form-control" id="basicInput" placeholder="password confirm" name="password_confirmation">
                    </div>
                </div> <br>


            </div>
            <button class="btn btn-success" type="submit">Create</button>
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