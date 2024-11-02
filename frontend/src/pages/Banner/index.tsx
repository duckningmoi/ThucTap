import React from 'react';

const Banner = () => {
  return (
    <div
      style={{
        backgroundImage: `url('https://i.imgur.com/mAGsoza.png')`, // Thay bằng đường dẫn hình ảnh của bạn
        backgroundSize: 'contain', // Đảm bảo hình ảnh được hiển thị đầy đủ mà không bị cắt
        backgroundRepeat: 'no-repeat', // Không lặp lại hình ảnh
        backgroundPosition: 'center', // Canh giữa hình ảnh
        height: '500px', // Chiều cao của banner
        width: '100%', // Đảm bảo hình ảnh phủ toàn bộ chiều rộng
      }}
    ></div>
  );
};

export default Banner;
