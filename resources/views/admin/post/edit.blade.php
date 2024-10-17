@extends('admin.master')
@section('title')
    Sửa bài viết
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Chỉnh Sửa Bài Viết</h4>
        </div>

        <form action="{{ route('admin.post.update', $post['slug']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="basicInput" class="form-label">Tên bài viết</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Tên bài viết"
                                name="name" value="{{ old('name', $post['name']) }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Ảnh bài viết</label>
                            <input class="form-control" type="file" id="formFile" name="image">
                            @if($post['image'])
                                <img src="{{ Storage::url($post['image']) }}" alt="Ảnh bài viết" class="mt-2" width="100px">
                            @endif
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="helperText" class="form-label">Bài viết thuộc khu vực</label>
                            <input type="text" id="helperText" class="form-control" placeholder="Location"
                                name="location" value="{{ old('location', $post['location']) }}">
                            @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Trạng thái bài viết</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_approved" id="flexRadioDefault1"
                                    value="0" {{ old('is_approved', $post['is_approved']) == 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Không đăng bài
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_approved" id="flexRadioDefault2"
                                    value="1" {{ old('is_approved', $post['is_approved']) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Đăng bài
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="basicSelect" class="form-label">Danh mục bài viết</label>
                            <select class="form-select" id="basicSelect" name="category_id">
                                <option value="">--chọn--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['_id'] }}"
                                        {{ old('category_id', $post['category_id']) == $category['_id'] ? 'selected' : '' }}>
                                        {{ $category['name'] }}
                                    </option>
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
                                <textarea id="editor" name="content" class="form-control">{{ old('content', $post['content']) }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Ảnh bổ sung</label>
                            <div id="image-fields">
                                @if(isset($images) && count($images) > 0)
                                    @foreach ($images as $img)
                                        <div class="mb-3 d-flex align-items-center">
                                            <input type="file" name="images[{{ $img['_id'] }}]" class="form-control me-2">
                                            <img src="{{ Storage::url($img['image']) }}" alt="Image" class="img-thumbnail me-2" style="width: 100px; height: auto;">
                                            <input type="text" name="tieude[{{ $img['_id'] }}]" 
                                                   value="{{ $img['tieude'] ?? 'No description' }}" 
                                                   placeholder="Tiêu đề ảnh" 
                                                   class="form-control me-2">
                                            <button type="button" class="btn btn-danger remove-image" data-id="{{ $img['_id'] }}">
                                                <i class="bi bi-trash"></i> Xóa
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No images found.</p>
                                @endif
                            </div>
                            <button type="button" id="add-image" class="btn btn-primary mt-2">
                                <i class="fas fa-plus"></i> Thêm Ảnh
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Cập nhật</button>
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
