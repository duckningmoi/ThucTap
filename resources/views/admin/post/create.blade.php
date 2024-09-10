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
                <h4 class="card-title">Basic Inputs</h4>
            </div>

            <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Tên bài viết</label>
                                <input type="text" class="form-control" id="basicInput" placeholder="tên bài viết"
                                    name="name">
                            </div>

                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Ảnh bài viết</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="helperText">Bài viết thuộc khu vực</label>
                                <input type="text" id="helperText" class="form-control" placeholder="location"
                                    name="location">
                            </div>
                            @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="helperText">trạng thái bài viết</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_approved" id="flexRadioDefault1"
                                        value="0">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Không đăng bài
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_approved" id="flexRadioDefault2"
                                        checked value="1">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        đăng bài
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 mb-4">
                                    <label for="helperText">Danh mục bài viết</label>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="basicSelect" name="category_id">
                                            <option>--chọn--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category['_id'] }}">{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </fieldset>
                                </div>
                            </div>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <section class="section">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Nội dung bài viết</h4>
                                            </div>
                                            <div class="card-body">
                                                <textarea id="editor" name="content"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @error('content')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div>
                                <div id="image-fields">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Ảnh bài viết</label>
                                        <input class="form-control" type="file" id="formFile" name="images[]">
                                        <br>
                                        <input type="text" name="tieude[]" placeholder="tiêu đề ảnh">
                                    </div>
                                </div>
                                <div>
                                    <button type="button" id="add-image" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Thêm Ảnh
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit">Gửi</button>
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
