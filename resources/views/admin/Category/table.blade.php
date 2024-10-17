@extends('admin.master')
@section('title')
    Danh Sách Danh Mục
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

    <!-- Responsive tables start -->


    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Thêm danh mục</a>
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Tên Danh Mục</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stt = 1;
                        @endphp
                        @foreach ($categories as $cate)
                            <tr>
                                <td>{{ $stt++ }}</td>
                                <td>{{ $cate['name'] }}</td>
                                <td>
                                    <a href="{{ route('admin.category.edit', $cate['slug']) }}" class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('admin.category.destroy', $cate['slug']) }}" method="post" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Bạn có chắc chắn muốn xóa?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection
