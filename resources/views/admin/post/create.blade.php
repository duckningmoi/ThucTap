<div>
    <!-- He who is contented is rich. - Laozi -->
</div>
@extends('admin.master')
@section('title')
    Thêm bài viết
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Thêm Bài Viết Mới</h4>
        </div>

        <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="basicInput" class="form-label">Tên bài viết</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Tên bài viết" name="name">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Ảnh bài viết</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="helperText" class="form-label">Bài viết thuộc khu vực</label>
                            <input type="text" id="helperText" class="form-control" placeholder="Location" name="location">
                            @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Trạng thái bài viết</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_approved" id="flexRadioDefault1" value="0">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Không đăng bài
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_approved" id="flexRadioDefault2" checked value="1">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Đăng bài
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="basicSelect" class="form-label">Danh mục bài viết</label>
                            <select class="form-select" id="basicSelect" name="category_id">
                                <option value="">--Chọn--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['_id'] }}">{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Nội dung bài viết</h4>
                            </div>
                            <div class="card-body">
                                <textarea name="content" class="form-control" rows="6"></textarea>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Ảnh bổ sung</label>
                            <div id="image-fields">
                                <div class="mb-3 d-flex align-items-center">
                                    <input class="form-control me-2" type="file" name="images[]">
                                    <input type="text" name="tieude[]" placeholder="Tiêu đề ảnh" class="form-control me-2">
                                </div>
                            </div>
                            <button type="button" id="add-image" class="btn btn-primary mt-2">
                                <i class="fas fa-plus"></i> Thêm Ảnh
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Gửi</button>
            </div>
        </form>
    </div>
</section>

@endsection

@section('js')
    <script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>

    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}
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
