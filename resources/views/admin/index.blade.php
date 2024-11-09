@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon purple">
                            <i class="iconly-boldShow"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Người xem</h6>
                        <h6 class="font-extrabold mb-0">{{$views}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon blue">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Người đăng ký</h6>
                        <h6 class="font-extrabold mb-0">{{$follows}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Biểu đồ cột -->
    <h4 class="text-muted font-semibold">Thống kê đăng bài theo tháng</h4>
    <div id="chart"></div>

    <style>
        #chart {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            height: 400px;
            margin-top: -50px;
            width: 80%;
            overflow: hidden;
            /* Ngăn các cột vượt quá chiều cao */
        }

        .bar-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bar {
            width: 50px;
            background-color: #435ebe;
            margin-bottom: 5px;
            height: 0px;
            transition: height 0.3s ease;
            border: 1px solid red;
            /* Kiểm tra xem các cột có hiển thị không */
            border-radius: 5px;
            position: relative;
            /* Để căn giữa số lượng bên trong cột */
        }

        .bar-value {
            position: absolute;
            /* Đặt giá trị ở vị trí cố định bên trong cột */
            bottom: -20px;
            /* Đưa số lượng xuống dưới đáy cột */
            width: 100%;
            color: white;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #435ebe;
        }

        .bar-label {
            margin-top: 10px;
        }
    </style>
    <script>
        // Truyền dữ liệu thống kê từ PHP sang JavaScript
        const statistics = @json($statistics);

        // Kiểm tra dữ liệu thống kê
        console.log("Statistics data:", statistics);

        // Tạo mảng dữ liệu cho biểu đồ
        const data = [];
        let maxValue = 0; // Số lượng bài viết tối đa để tính tỷ lệ

        // Mảng các tháng tiếng Anh
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // Lấy chiều cao của thẻ chứa biểu đồ
        const chartHeight = document.getElementById('chart').offsetHeight;

        // Tạo dữ liệu cho biểu đồ từ tháng 1 đến tháng 12
        for (let i = 0; i < 12; i++) {
            const value = statistics[i + 1] || 0; // Lấy giá trị từ thống kê (1 -> 12 tháng)
            data.push({
                label: monthNames[i], // Đặt tên tháng bằng tiếng Anh
                value: value
            });
            if (value > maxValue) {
                maxValue = value; // Cập nhật giá trị cao nhất
            }
        }

        // Kiểm tra maxValue
        console.log("Max Value:", maxValue); // In ra giá trị tối đa

        // Nếu maxValue = 0 thì không có bài viết, chiều cao của tất cả cột sẽ bằng 0
        if (maxValue === 0) {
            alert("Không có bài viết nào trong năm.");
        }

        // Tính tỷ lệ cho mỗi tháng
        data.forEach(item => {
            // Nếu không có bài viết cho tháng, đặt tỷ lệ chiều cao là 0
            if (maxValue > 0) {
                // Tính tỷ lệ chiều cao cho cột, đảm bảo chiều cao không vượt quá chiều cao của thẻ #chart
                item.height = (item.value / maxValue) * chartHeight; // Tính tỷ lệ theo chiều cao của thẻ chứa
            } else {
                item.height = 0; // Nếu không có bài viết, chiều cao là 0
            }
            console.log("Height for " + item.label + ": " + item.height); // In ra chiều cao tính được
        });

        // Lấy phần tử chứa biểu đồ
        const chartContainer = document.getElementById('chart');

        // Tạo các cột cho mỗi phần tử trong dữ liệu
        data.forEach(item => {
            // Tạo cột
            const bar = document.createElement('div');
            bar.classList.add('bar');
            bar.style.height = item.height + 'px'; // Đặt chiều cao cột theo tỷ lệ phần trăm

            // Tạo phần giá trị bên trong cột (số lượng bài viết)
            const barValue = document.createElement('div');
            barValue.classList.add('bar-value');
            barValue.textContent = item.value; // Hiển thị số lượng bài viết bên trong cột

            // Thêm phần giá trị vào cột
            bar.appendChild(barValue);

            // Tạo nhãn bên dưới cột
            const label = document.createElement('div');
            label.classList.add('bar-label');
            label.style.marginTop = '10px';
            label.textContent = item.label; // Hiển thị tên tháng bằng tiếng Anh

            // Thêm cột và nhãn vào container
            const barContainer = document.createElement('div');
            barContainer.classList.add('bar-container');
            barContainer.appendChild(bar);
            barContainer.appendChild(label);
            chartContainer.appendChild(barContainer);
        });
    </script>

    @endsection