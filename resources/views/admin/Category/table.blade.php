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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        @csrf
                        <input type="text" name="name" placeholder="Tên Danh Mục">
                        <button type="submit">Thêm Mới</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <table class="table w-50 ms-xxl-5" border="1">
            <thead>
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
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $stt++ }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $cate['name'] }}
                            </p>
                        </td>
                        <td>
                            <a href="{{ route('admin.category.edit', $cate['slug']) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('admin.category.destroy', $cate['slug']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('bạn có chắc chắn muốn xóa?')" type="submit"
                                    class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
