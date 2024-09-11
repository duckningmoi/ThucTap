<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>

@extends('admin.master')
@section('title')
Danh Sách Bài Viết
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

<div class="row">

    <table class="table w-50 ms-xxl-5" border="1">

        <thead>
            <a href="{{route('admin.user.create')}}" class="mb-xxl-5 btn btn-success">Thêm Mới</a>
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password<th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $stt = 1;
            @endphp
            @foreach ($users as $user)
            <tr>
                <td>
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $stt++ }}
                    </p>
                </td>
                <td>
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $user['name'] }}
                    </p>
                </td>
                <td>
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $user['email'] }}
                    </p>
                </td>
                <td>
                    <p style="font-family: 'Times New Roman', Times, serif; font-size: 15px;">{{ $user['password'] }}
                    </p>
                </td>
                <td>
                    <a href="{{ route('admin.user.edit', (string)$user['_id']) }}" class="btn btn-info">Edit </a>
                    <form action="{{ route('admin.user.destroy', $user['_id']) }}" method="post">
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