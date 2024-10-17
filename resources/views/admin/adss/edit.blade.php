<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>
@extends('admin.master')
@section('title')
Danh Sách Quảng cáo 
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
@error('name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Chỉnh Sửa Quảng Cáo</h4>
        </div>

        <form action="{{ route('admin.adss.update', $adss['_id']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Ảnh quảng cáo</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <img src="{{Storage::url($adss['image'])}}" alt="" width="100px">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="link_url" class="form-label">Link quảng cáo</label>
                            <input type="text" class="form-control" id="link_url" placeholder="Link quảng cáo" name="link_url" value="{{ old('link_url', $adss['link_url']) }}" required>
                            @error('link_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="vitri" class="form-label">Vị trí</label>
                            <input type="text" class="form-control" id="vitri" placeholder="Vị trí" name="vitri" value="{{ old('vitri', $adss['vitri']) }}" required>
                            @error('vitri')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kích hoạt</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active" id="active" value="active" {{ $adss['active'] == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="active" id="is_active" value="is_active" {{ $adss['active'] == 'is_active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Is Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">Cập Nhật</button>
                </div>
            </div>
        </form>
    </div>
</section>


@endsection