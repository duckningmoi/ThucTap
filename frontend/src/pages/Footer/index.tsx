import React from 'react';

const Footer = () => {
  return (
    <footer className="bg-light text-dark pt-4 border-top">
      <div className="container">
        <div className="row">
          {/* <div className="d-flex align-items-center mb-3">
              <img 
                src="https://vnexpress.net/favicon.ico" 
                alt="VNExpress Logo" 
                className="mr-2" 
                style={{ height: '24px' }} 
              />
              <span className="font-weight-bold">Báo điện tử VNEXPRESS</span>
            </div> */}
          <div className="col-md-4 d-flex flex-column">
            
            
            <div>
              Báo tiếng Việt nhiều người xem nhất <br />
              Thuộc Bộ Khoa học và Công nghệ <br />
              Số giấy phép: 548/GP-BTTTT do Bộ Thông tin và Truyền thông cấp ngày 24/08/2021
            </div>
          </div>

          {/* Thông tin liên hệ và điều khoản */}
          <div className="col-md-4 d-flex flex-column">
            
            <div>
              Tổng biên tập: Phạm Văn Hiếu <br />
              Địa chỉ: Tầng 10, Tòa A FPT Tower, số 10 Phạm Văn Bạch, Dịch Vọng, Cầu Giấy, Hà Nội <br />
              Điện thoại: 024 7300 8899 - máy lẻ 4500 <br />
              Email: webmaster@vnexpress.net
            </div>
          </div>
          <div className="col-md-4 d-flex flex-column">
            <div>© 1997-2024. Toàn bộ bản quyền thuộc VnExpress.</div>
          </div>
        </div>

        
      </div>
    </footer>
  );
};

export default Footer;
