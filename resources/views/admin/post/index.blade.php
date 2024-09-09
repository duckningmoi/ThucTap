<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>

@extends('admin.master')
@section('title')
    Danh Sách Bài Viết
@endsection
@section('content')
    @if (session('success'))
        <script>
            alert(<?= session('messages') ?>)
        </script>
    @elseif(session('error'))
        <script>
            alert(<?= session('error') ?>)
        </script>
    @elseif(session('success'))
        <script>
            alert(<?= session('success') ?>)
        </script>
    @endif
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

    <div class="row">

        <table class="table w-50 ms-xxl-5" border="1">
           
            <thead>
                <a href="{{route('admin.post.create')}}" class="btn btn-primary">thêm bài viết</a>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Content</th>
                    <th>Location</th>
                    <th>Is_approved</th>
                    <th>Viewer</th>
                    <th>User_id</th>
                    <th>Category_id</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $stt = 1;
                @endphp
                @foreach ($posts as $post)
                    <tr>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $stt++ }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $post['name'] }}
                            </p>
                        </td>
                        <td>
                            @if ($post['image'])
                                <img src="{{ Storage::url($post['image']) }}" alt="Hình ảnh" width="100px">
                            @else
                                không có ảnh
                            @endif
                        </td>

                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $post['content'] }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">
                                {{ $post['location'] }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">
                                {{ $post['is_approved'] }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $post['viewer'] }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $post['user_id'] }}
                            </p>
                        </td>
                        <td>
                            <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">
                                {{ $post['category_id'] }}
                            </p>
                        </td>
                        <td>
                            <a href="{{ route('admin.post.edit', $post['slug']) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('admin.post.destroy', $post['slug']) }}" method="post">
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
