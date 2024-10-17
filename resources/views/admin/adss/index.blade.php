<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
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

<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.adss.create') }}" class="mb-3 btn btn-success">Thêm Mới</a>
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>STT</th>
                        <th>Ảnh quảng cáo</th>
                        <th>Link quảng cáo</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $stt = 1;
                    @endphp
                    @foreach ($adss as $ads)
                    <tr>
                        <td>{{ $stt++ }}</td>
                        <td>
                            <img src="{{ Storage::url($ads['image']) }}" alt="Ảnh quảng cáo" width="100">
                        </td>
                        <td>{{ $ads['link_url'] }}</td>
                        <td>{{ $ads['vitri'] }}</td>
                        <td>
                            <a href="{{ route('admin.adss.edit', (string)$ads['_id']) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('admin.adss.destroy', $ads['_id']) }}" method="post" style="display:inline;">
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