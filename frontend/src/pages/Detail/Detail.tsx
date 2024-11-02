import React from 'react';
import Footer from '../Footer';
import Navbar from '../Navbar';
import Header from '../Header';
import Banner from '../Banner';
import { ArrowLeftOutlined } from '@ant-design/icons';
import { Flex, Input } from 'antd';


const NewsLayout = () => {

    const { TextArea } = Input;

const onChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
  console.log('Change:', e.target.value);
};
  return (
    <>
    <Navbar/>
    <Header/>
    <Banner/>
    <div className="container my-4 news-container">
      {/* Main content */}
      <div className="main-content">
        <div className="news-content">
          
          <div className="section">
            <h1>Bước ngoặt đưa nữ sinh Bách khoa đến ngành thiết kế vi mạch</h1>
            <p>
              Phương Linh trúng tuyển nhiều công ty với mức lương mơ ước, giành học bổng đại học hàng đầu Pháp, sau một năm biết đến ngành thiết kế vi mạch.

            Nguyễn Phương Linh, 22 tuổi, Hà Nội, đang trải qua tháng đầu học chương trình thạc sĩ - tiến sĩ, định hướng thiết kế vi mạch tại Viện Bách khoa Paris (IP Paris), ngôi trường xếp hạng 46 thế giới, theo QS.

            Linh giành học bổng này từ khi chưa nhận bằng tốt nghiệp ở Bách khoa Hà Nội. Cô đạt loại xuất sắc với điểm tổng kết 3.92/4, ngành Kỹ thuật Điện tử - Viễn thông.

            Với Linh, đây là bước chuyển bất ngờ, bởi chưa từng định du học về thiết kế vi mạch, trước năm học cuối ở trường.

            "Mọi thứ đến với mình như một cái duyên", Linh nói.
            </p>
          </div>
        </div>
        <div className='back-icon'>
            <button><ArrowLeftOutlined /></button>
        </div>

        <div className='binhluan'>
            <h2>Bình luận</h2>
            <div className='input'>
                <Flex vertical gap={32}>
                    <Input showCount maxLength={50} onChange={onChange} />
                </Flex>
            </div>
            
        </div>

        
      </div>

      {/* Sidebar content */}
      <div className="news-sidebar">
        <div>
        <h3>Xem nhiều</h3>
        <ul>
          <li>
            <a href="#1">Phú Đức vô địch Olympia 2024</a>
            <span>140</span>
          </li>
          <li>
            <a href="#2">Nhà vô địch Olympia: Bí quyết là sự gan lì và chiến thuật thông minh</a>
            <span>150</span>
          </li>
          <li>
            <a href="#3">Trường đại học thu sai 37 tỷ đồng học phí</a>
            <span>88</span>
          </li>
        </ul>
        </div>
        <div className="lienquan">
            <div className="lq-item">
            
            <div className="lq-item-content">
              <h3>Liên quan</h3>
              <ul>
                <li>
                    <img
                    src="https://via.placeholder.com/110x66" /* Replace with actual image */
                    alt="Sinh viên Bách khoa ăn cơm"
                    />
                    <p>
                        Sinh viên Bách khoa tố phải ăn cơm thừa, có dị vật
                    </p>
                    
                </li>
                <li>
                    <img
                    src="https://via.placeholder.com/110x66" /* Replace with actual image */
                    alt="Sinh viên Bách khoa ăn cơm"
                    />
                    <p>
                        Sinh viên Bách khoa tố phải ăn cơm thừa, có dị vật
                    </p>
                    
                </li>
                <li>
                    <img
                    src="https://via.placeholder.com/110x66" /* Replace with actual image */
                    alt="Sinh viên Bách khoa ăn cơm"
                    />
                    <p>
                        Sinh viên Bách khoa tố phải ăn cơm thừa, có dị vật
                    </p>
                    
                </li>
                
                </ul>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer/>
    </>
  );
};

export default NewsLayout;
