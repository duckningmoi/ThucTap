@extends('admin.master')
@section('title')
    Sửa bài viết
@endsection
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
            </div>

            <form action="{{ route('admin.user.update', $user['_id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Tên người dùng</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="tên người dùng" name="name" value="{{ $user['name'] }}">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> <br>


                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        <input type="email" class="w-50 form-control" id="basicInput" placeholder="email" name="email" value="{{ $user['email'] }}">
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> <br>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="basicInput">Password</label>
                        <input type="text" class="form-control" id="basicInput" placeholder="password" name="password" value="{{ $user['password'] }}">
                    </div>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div> <br>


            </div>
                    <button type="submit">Update</button>
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
                <input type="text" name="tieude[]" placeholder="Tiêu đề ảnh">
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
