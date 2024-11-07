<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function shareLink(Request $request)
    {
        // Nhận URL và các thông tin từ client
        $url = $request->input('url');
        $title = $request->input('title', 'Tiêu đề mặc định');
        $description = $request->input('description', 'Mô tả mặc định');
        $imageUrl = $request->input('image', 'https://example.com/images/hinh-anh.jpg');

        // Kiểm tra xem URL có tồn tại không
        if (!$url) {
            return response()->json([
                'status' => 'error',
                'message' => 'URL là bắt buộc'
            ], 400);
        }

        // Tạo URL chia sẻ Facebook
        $facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);

        // Trả về dữ liệu cho client
        return response()->json([
            'status' => 'success',
            'facebookShareUrl' => $facebookShareUrl,
            'meta' => [
                'title' => $title,
                'description' => $description,
                'image' => $imageUrl
            ]
        ]);
    }
}
