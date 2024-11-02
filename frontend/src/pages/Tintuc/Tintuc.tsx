import React from 'react'
import Footer from '../Footer'
import Navbar from '../Navbar'
import Header from '../Header'
import Banner from '../Banner'

const Tintuc = () => {
  return (
    <>
    <Navbar/>
    <Header/>
    <Banner/>
    <div className="container my-4">
      

      <div className="news-container">
      {/* Main content */}
      <div className="main-content">
        <div className="news-content">
          <div className="image-section">
            <img
              src="https://www.shutterstock.com/image-photo/silhouette-woman-showing-strong-muscle-600nw-2512977479.jpg" /* Replace with actual image */
              alt="News"
            />
          </div>
          <div className="content-section">
            <h2>Bước ngoặt đưa nữ sinh Bách khoa đến ngành thiết kế vi mạch</h2>
            <p>
              Phương Linh trúng tuyển nhiều công ty với mức lương mơ ước, giành học bổng đại học hàng đầu Pháp,
              sau một năm biết đến ngành thiết kế vi mạch.
            </p>
          </div>
        </div>

        {/* New Section Below Main Content */}
        <div className="news-articles">
          <div className="news-item">
            <img
              src="https://via.placeholder.com/150x100" /* Replace with actual image */
              alt="Sinh viên Bách khoa ăn cơm"
            />
            <div className="news-item-content">
              <h3>Sinh viên Bách khoa tố phải ăn cơm thừa, có dị vật</h3>
              <p>
                Một số sinh viên Đại học Bách khoa Hà Nội nói phải ăn suất cơm mát vệ sinh, có dị vật,
                thậm chí là cơm thừa, khi học môn Giáo dục Quốc phòng và An ninh tại trường.
              </p>
              <span>162</span>
            </div>
          </div>

          <div className="news-item">
            <img
              src="https://via.placeholder.com/150x100" /* Replace with actual image */
              alt="Học thử lớp Tú tài"
            />
            <div className="news-item-content">
              <h3>Học thử lớp Tú tài quốc tế IB với chuyên gia trường Windermere US</h3>
              <p>
                Tìm hiểu các kỹ năng mềm trong IB có tác động như thế nào đến sự nghiệp và cuộc sống.
              </p>
              <span>Sponsored by Tư Vấn Du Học Yola</span>
            </div>
          </div>

          {/* Pagination */}
          <div className="pagination">
            <button>{'<'}</button>
            <button className="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>{'>'}</button>
          </div>
        </div>
      </div>

      {/* Sidebar content */}
      <div className="news-sidebar">
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
          <li>
            <a href="#3">Trường đại học thu sai 37 tỷ đồng học phí</a>
            <span>88</span>
          </li>
          <li>
            <a href="#3">Trường đại học thu sai 37 tỷ đồng học phí</a>
            <span>88</span>
          </li>
          <li>
            <a href="#3">Trường đại học thu sai 37 tỷ đồng học phí</a>
            <span>88</span>
          </li>
          <li>
            <a href="#3">Trường đại học thu sai 37 tỷ đồng học phí</a>
            <span>88</span>
          </li>
          <li>
            <a href="#3">Trường đại học thu sai 37 tỷ đồng học phí</a>
            <span>88</span>
          </li>
        </ul>
      </div>
    </div>
    </div>
    <Footer/>
    </>
  )
}

export default Tintuc