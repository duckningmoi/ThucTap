import React, { useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';


const MainNews = () => {
  const [startDate, setStartDate] = useState(new Date());
  const [currentPage, setCurrentPage] = useState(1);
  const totalPages = 4;

  const handlePageChange = (page:any) => {
    if (page >= 1 && page <= totalPages) {
      setCurrentPage(page);
    }
  };
  return (
    <><hr className="border-t-2 border-gray-300" /><div className="container mx-auto p-4 w-4/5">
      
      <div className="w-5/10  grid grid-cols-2 gap-4 items-stretch w-4/5">
        {/* Hình ảnh tin tức */}
        <div>
          <img
            src="https://i1-vnexpress.vnecdn.net/2024/10/14/1-jpeg-1728918762-1728918779-2-2587-8914-1728923451.jpg?w=680&h=408&q=100&dpr=1&fit=crop&s=eYi14Tu3T_N7mandyNMBfw" // Thay thế bằng URL ảnh của bạn
            alt="Hiệu trưởng Y Hà Nội"
            className="w-full h-auto" />
        </div>

        {/* Nội dung tin tức với nền màu xám nhạt, cao bằng ảnh */}
        <div className="bg-gray-100 p-6 flex flex-col justify-center">
          <h2 className="text-3xl font-bold">
            Hiệu trưởng Y Hà Nội nhận huân chương Cành cọ Hàn lâm
          </h2>
          <p className="mt-4 text-gray-600">
            GS.TS Nguyễn Hữu Tú, Hiệu trưởng Đại học Y Hà Nội, được trao huân chương cao quý của chính phủ Pháp vì những đóng góp trong phát triển hợp tác Y Khoa giữa hai nước.
          </p>
          <p className="mt-2 text-blue-600 font-semibold">Tin tức</p>
        </div>
      </div>
      <hr className="border-t-2 border-gray-300" />
      <div className="grid grid-cols-3 gap-8 w-4/5">
        {/* Tin tức 1 */}
        <div>
          <h3 className="text-xl font-bold">
            Giáo sư đại học top đầu Mỹ than lương thấp, vô gia cư
          </h3>
          <p className="text-gray-600 mt-2">
            Daniel McKeown, giáo sư ở Đại học California-Los Angeles (UCLA), nói mức lương 70.000 USD/năm khiến ông không đủ sống, phải vô gia cư, gây sốc cho nhiều người trên TikTok.
          </p>
          <p className="text-gray-400 mt-4">Tin tức • 36</p>
        </div>

        {/* Tin tức 2 */}
        <div>
          <h3 className="text-xl font-bold">
            🌟 Đèo nào có 'thiên hạ đệ nhất hùng quan'?
          </h3>
          <p className="text-gray-600 mt-2">
            "Thiên hạ đệ nhất hùng quan" nằm trên một con đèo nổi tiếng. Tên gọi này là lời đề tặng của vua Lê Thánh Tông khi dừng chân ngắm cảnh tại đây.
          </p>
          <p className="text-gray-400 mt-4">Trải nghiệm</p>
        </div>

        {/* Tin tức 3 */}
        <div>
          <h3 className="text-xl font-bold">
            Đại học Y Khoa Phạm Ngọc Thạch dự kiến xét chứng chỉ quốc tế
          </h3>
          <p className="text-gray-600 mt-2">
            Trường Y khoa Phạm Ngọc Thạch dự kiến xét chứng chỉ quốc tế để tuyển sinh đầu vào, kể từ năm 2025.
          </p>
          <p className="text-gray-400 mt-4">Đại học</p>
        </div>
      </div>
      <hr className="border-t-2 border-gray-400" />{/*gạch chân */}
      <div className="flex space-x-8 text-pink-600">
        <a href="#" className="underline text-pink-600">
          Tuyển sinh đại học 2025
        </a>
        <a href="#" className="underline text-pink-600">
          Du học Mỹ
        </a>
        <a href="#" className="underline text-pink-600">
          Thi lớp 10 năm 2025
        </a>
      </div>
      <hr className="border-t-2 border-gray-300 text-pink-600" />
     {/* Lưới tin tức */}
     <div className="grid grid-cols-3 gap-6">
        {/* Cột chính với các tin lớn */}
        <div className="col-span-2 space-y-4">
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/7106c9a80e7ab724ee6b-1-1728885-4184-4009-1728888736.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=b16hpZpoMoNcKGn1_tyUlw"
              alt="Học sinh THPT Lê Quý Đôn"
              className="w-5/6 h-48 object-cover mb-2"
            />
            <div>
              <h3 className="text-lg font-bold">
                Gần 1.400 học sinh trường THPT Lê Quý Đôn dừng ăn bán trú
              </h3>
              <p className="text-gray-600">
                THPT Lê Quý Đôn phải dừng ăn bán trú, sau khi 5 em phát hiện vi khuẩn trong bữa trưa.
              </p>
            </div>
          </div>

          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/0bb077b6afa116ff4fb0-172879320-1569-6037-1728857484.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=D_v_y2b83SN3bBhqKR5gzQ"
              alt="Nữ sinh tốt nghiệp thủ khoa"
              className="w-5/6 h-48 object-cover mb-2"
            />
            <div>
              <h3 className="text-lg font-bold">
                Nữ sinh tốt nghiệp thủ khoa Học viện Quản lý
              </h3>
              <p className="text-gray-600">
                Nguyễn Trân Trọng Kỳ Duyên xuất sắc đạt điểm thủ khoa với thành tích nổi bật.
              </p>
            </div>
          </div>

          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/image001-1728900219-3663-1728900730.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=txnUfyGFCUMAh1V0LDnGJQ"
              alt="FPT Software đầu tư"
              className="w-5/6 h-48 object-cover mb-2"
            />
            <div>
              <h3 className="text-lg font-bold">
                FPT Software đầu tư 125 tỷ đồng đào tạo nguồn lực ICT tiếng Nhật
              </h3>
              <p className="text-gray-600">
                FPT Software đã đầu tư 125 tỷ đồng để đào tạo các chuyên gia ICT tiếng Nhật.
              </p>
            </div>
          </div>

          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/victoriaschoolbannersettop1210-3104-2092-1728902148.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=2Baem0kLgXl69UUfHT-7gA"
              alt="STEAM for Girls"
              className="w-5/6 h-48 object-cover mb-2"
            />
            <div>
              <h3 className="text-lg font-bold">
                'STEAM for Girls' ươm mầm sáng kiến khoa học
              </h3>
              <p className="text-gray-600">
                Phạm Thùy Linh và đội ngũ của cô được vinh danh với dự án STEAM for Girls.
              </p>
            </div>
          </div>
          
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/image003-1728891270-8473-1728891290.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=jbr1JJsiGYQzZ-zIJ7zTrw"
              alt="STEAM for Girls"
              className="w-5/6 h-48 object-cover mb-2"
            />
            <div>
              <h3 className="text-lg font-bold">
                'Nhà vô địch Olympia nhận học bổng 100% từ đại học GREENWIC
              </h3>
              <p className="text-gray-600">
                Đại học Greenwich trao học bổng 100%, trị giá 600tr đồng cho nhà vô địch đường lên đỉnh Olympia 2024.
              </p>
            </div>
          </div>
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/381360844-663798832516934-8439-1757-5861-1728892251.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=9ymPAY99jjn0QvOkGA0ILg"
              alt="STEAM for Girls"
              className="w-5/6 h-48 object-cover mb-2"
            />
            <div>
              <h3 className="text-lg font-bold">
                'Trải nghiệm lớp tiểu học tại trường học quốc tế vào 24/10
              </h3>
              <p className="text-gray-600">
                Cùng con khám phá chất lượng giáo dục toàn diện trực tiếp tại trường, giải đáp thắc mắc cho các phụ huynh.
              </p>
            </div>
          </div>
          
        </div>
        

        {/* Cột bên phải với các chủ đề nhỏ hơn */}
        <div className="space-y-4">
          <div className="bg-gray-100 p-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/snhdndgb-1728877887-1832-1728878857.jpg?w=380&h=228&q=100&dpr=1&fit=crop&s=wctBgRo-K3hBi6MisAoQ7Q"
              alt="Du học"
              className="w-full h-auto object-cover mb-2"
            />
            <h3 className="text-lg font-bold">Du học</h3>
            <p className="text-gray-600">Hơn 60 trường đại học quốc tế quy tụ tại triển lãm du học.</p>
          </div>
          <hr className="border-t-2 border-gray-300" />
          <div className="bg-gray-100 p-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/13/z5925093557722-f43759deb08aa8a-9572-7154-1728797846.jpg?w=380&h=228&q=100&dpr=1&fit=crop&s=UOx0lBv08cb2h5At0cNUxQ"
              alt="Chân dung"
              className="w-full h-auto object-cover mb-2"
            />
            <h3 className="text-lg font-bold">Chân dung</h3>
            <p className="text-gray-600">
              Nhà vô địch Olympia: Bí quyết là sự gan lì và chiến thuật thông minh.
            </p>
          </div>
          <hr className="border-t-2 border-gray-300" />
          <div className="bg-gray-100 p-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/13/Ngnhyakhoa-1728810153-1711-1728810296.png?w=380&h=228&q=100&dpr=1&fit=crop&s=Mjnm33mtTLDqQ1CvZaW1vg"
              alt="Tuyển sinh"
              className="w-full h-auto object-cover mb-2"
            />
            <h3 className="text-lg font-bold">Tuyển sinh</h3>
            <p className="text-gray-600">Đại học Thương mại mở 7 chương trình mới.</p>
          </div>
          <hr className="border-t-2 border-gray-300" />
          <div className="bg-gray-100 p-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/13/kimcuongg-1728809254-8415-1728809262.jpg?w=380&h=228&q=100&dpr=1&fit=crop&s=lEl4GDYfWDp_OdJMrDVRWg"
              alt="Trắc nghiệm"
              className="w-full h-auto object-cover mb-2"
            />
            <h3 className="text-lg font-bold">Trắc nghiệm</h3>
            <p className="text-gray-600">Nước nào có trữ lượng kim cương lớn nhất thế giới?</p>
          </div>
        </div>
      </div>
      <hr className="border-t-2 border-gray-300" />
      <hr className="border-t-2 border-gray-300" />


      <div className="grid grid-cols-8 gap-6">
        {/* Cột bên trái (2 phần) */}
        <div className="col-span-2 space-y-6">
          <div className="bg-gray-100 p-4">
              <h3 className="text-lg font-bold">10.000 sách giáo khoa cho học sinh vùng lũ</h3>
            <p className="text-gray-600">
              Tập đoàn giáo dục Đại Trường Phát trao tặng 10,000 sách giáo khoa và dụng cụ học tập cho học sinh vùng lũ ảnh hưởng bởi bão Yagi.
            </p>
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/12/image001-4247-1728702651-17287-3702-7619-1728726634.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=7-piywBqjGsgcFmSnMYGYw"
              alt="Trường DH FPT"
              className="w-full h-auto object-cover"
            />
          </div>

          <div className="bg-gray-100 p-4">
            <h3 className="text-lg font-bold">Giải pháp cho người suy giảm tĩnh mạch lâu ngày?</h3>
            <p className="text-gray-600">
            Bệnh suy giảm tĩnh mạch được cải thiện khi tìm ra giải pháp "Đúng người đúng bệnh".
            </p>
            <img
              src="https://static.eclick.vn/uploads/5x3/2024/05/31/t163429809886s153834s8218.jpeg"
              alt="Trường DH FPT"
              className="w-full h-auto object-cover"
            />
          </div>
        </div>

        {/* Cột giữa (4 phần) */}
        <div className="col-span-4 space-y-6">
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/image001-1728880913-3476-1728880955.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=6Wi0Pk9OrcfqZyUmaF6Z4A"
              alt="Trường DH FPT"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
                Trường ĐH FPT tập huấn Giáo dục STEM cho hơn 3.000 giáo viên
              </h3>
              <p className="text-gray-600">
                Trường Đại học FPT tập huấn cách sử dụng trí tuệ nhân tạo vào giảng dạy STEM cho hơn 3.000 giáo viên THPT tại Bình Định và TP HCM.
              </p>
            </div>
          </div>

          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/13/bandimieltsphbinnht-1728812852-7036-7426-1728813632.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=hvh1DSRo2FWpq1m1mlJ4vg"
              alt="Điểm trung bình IELTS"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
                Điểm trung bình IELTS của người Việt đạt hạng
              </h3>
              <p className="text-gray-600">
                Thí sinh Việt Nam đạt trung bình 6.2 điểm bài thi IELTS, xếp hạng 29/39 quốc gia và vùng lãnh thổ.
              </p>
            </div>
          </div>

          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/13/untitled-1728813847-1728813860-1919-1728813866.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=dpyvV3W3QTvIi4cysTE9Dw"
              alt="Phân biệt 'can', 'could', 'may'"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
                Phân biệt cách hỏi với 'can', 'could', 'may'
              </h3>
              <p className="text-gray-600">
                Tiếng Anh có nhiều cụm từ để hỏi như 'can', 'could', 'may'. Làm sao để phân biệt chính xác?
              </p>
            </div>
          </div>

          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/13/z5924911373801c4a0f3d2f094fd11-9118-9548-1728792688.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=ezE3wNqCMMhI3OGUyuvk7A"
              alt="Phú Đức vô địch Olympia"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
                Phú Đức vô địch Olympia 2024
              </h3>
              <p className="text-gray-600">
                Nam sinh Huế vô địch Olympia 2024 với 50.000 USD và nhiều thành tích khác.
              </p>
            </div>
          </div>
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/15/p1004433-1728966365-1728966381-7660-5008-1728966535.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=UZYidhk-MXDXq78aaNW63w"
              alt="Phú Đức vô địch Olympia"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
              Bút Smart Pen MC08 - công cụ hỗ trợ dịch đa ngôn ngữ
              </h3>
              <p className="text-gray-600">
              Với khả năng dịch 142 ngôn ngữ và tích hợp loạt tính năng mới, bút Smart Pen MC08 hỗ trợ người học cải thiện phát âm, tự tin giao tiếp. .
              </p>
            </div>
          </div>
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/14/royce-quad-hero-1728899445-794-8172-5037-1728916740.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=MsjZAIqdIiGz2PHRST5ntA"
              alt="Phú Đức vô địch Olympia"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
              Giáo sư đại học top đầu Mỹ than lương thấp, vô gia cư
              </h3>
              <p className="text-gray-600">
              Daniel McKeown, giáo sư ở Đại học California-Los Angeles (UCLA), nói mức lương 70.000 USD/năm khiến ông không đủ sống, 
              phải vô gia cư, gây sốc cho nhiều người trên TikTok. .
              </p>
            </div>
          </div>
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/12/dethi-png-1728727508-9805-1728727559.png?w=240&h=144&q=100&dpr=1&fit=crop&s=rvs53-iCru6SfZvczm_aHg"
              alt="Phú Đức vô địch Olympia"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
              Đề chọn đội tuyển Toán thi học sinh giỏi quốc gia của Hà Nội ngày 2
              </h3>
              <p className="text-gray-600">
              Hà NộiĐề thi chọn đội tuyển Toán ngày 2 gồm ba bài, giảm một so với ngày thi đầu tiên,
               dù cùng thời gian làm bài 180 phút, tổng điểm 20.
              </p>
            </div>
          </div>
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/11/449679921-884443453711112-4740-5930-7481-1728606034.jpg?w=240&h=144&q=100&dpr=1&fit=crop&s=ci7EZMX_EvvuwaHbfvgWxQ"
              alt="Phú Đức vô địch Olympia"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
              Đại học Mỹ ứng dụng AI giữa lo ngại gian lận
              </h3>
              <p className="text-gray-600">
              Mỹ-AI được giảng viên và sinh viên sử dụng rộng rãi, song các đại học loay hoay để đưa ra chính sách chung nhằm tránh gian lận 
              và thích ứng với sự thay đổi nhanh chóng của nó. 
              </p>
            </div>
          </div>
        </div>

        {/* Cột bên phải (2 phần) */}
        <div className="col-span-2 space-y-6">
        <div className="bg-gray-100 shadow-md rounded-lg overflow-hidden">
      {/* Hình ảnh tiêu đề */}
      <div>
        <img
          src="https://s1.vnecdn.net/vnexpress/restruct/c/v2963/ldpr/1006002/images/graphics/banner_taichinhlacquan_pc.jpg"
          alt="Tài chính lạc quan"
          className="w-full h-16 object-cover"
        />
      </div>

      {/* Nội dung bên trong */}
      <div className="p-4">
        {/* Tiêu đề bài viết lớn */}
        <h3 className="text-lg font-bold mb-2">Khi nào có thể dạy con về tiền?</h3>

        {/* Các bài viết phụ */}
        <ul className="space-y-2 text-sm">
  <li className="border-t pt-2">
    <a className="text-gray-700 no-underline">Cách giáo dục trẻ về quản lý tài chính</a>
  </li>
  <li className="border-t pt-2">
    <a className="text-gray-700 no-underline">Các bước lên ngân sách chi tiêu cho người trẻ</a>
  </li>
</ul>


        {/* Hình ảnh nhỏ dưới */}
        <div className="mt-4">
          <img
            src="https://i1-vnexpress.vnecdn.net/2024/09/30/image-1303593637-extractword-1-1264-9664-1727702438.png?w=300&h=180&q=100&dpr=1&fit=crop&s=ppCGIZUDmQ8TpATpXc7DkQ"
            alt="Bài viết liên quan"
            className="w-full h-36 object-cover rounded"
          />
        </div>
      </div>

      {/* Hợp tác bởi */}
      <div className="p-4 bg-gray-100 text-center">
        <p className="text-sm text-gray-500">Hợp tác bởi:</p>
        <div className="flex justify-center items-center space-x-2">
          <img
            src="https://s1.vnecdn.net/vnexpress/restruct/c/v2963/ldpr/1006002/images/graphics/logo.png"
            alt="VNExpress"
            className="w-12"
          />
          <img
            src="https://s1.vnecdn.net/vnexpress/restruct/c/v2963/ldpr/1006002/images/graphics/logo-sunlife.png"
            alt="SunLife"
            className="w-12"
          />
        </div>
      </div>
    </div>

          <div className="bg-gray-100 p-4">
            <h3 className="text-lg font-bold">Giáo dục 4.0</h3>
            <img
              src="https://i1-vnexpress.vnecdn.net/2024/10/11/ccc-1728637910-1728637919-9878-1728638023.png?w=300&h=180&q=100&dpr=1&fit=crop&s=ji-mxOtqKJcWb_5wR52InQ"
              alt="Giáo dục 4.0"
              className="w-full h-auto object-cover mb-2"
            />
            <p className="text-gray-600">
              Cậu bé 9 tuổi say mê công nghệ sau khóa học lập trình Scratch.
            </p>
            <div className="p-4 bg-gray-100 text-center">
        <p className="text-sm text-gray-500">Hợp tác bởi:</p>
        <div className="flex justify-center items-center space-x-2">
          <img
            src="https://s1.vnecdn.net/vnexpress/restruct/c/v2963/ldpr/1006002/images/graphics/logo.png"
            alt="VNExpress"
            className="w-12"
          />
          <img
            src="https://s1.vnecdn.net/vnexpress/restruct/i/v9504/v2_2019/pc/graphics/Funix.svg"
            alt="Funix"
            className="w-12"
          />
        </div>
      </div>
          </div>
          

          
        </div>
        
      </div>
      <hr className="border-t-2 border-gray-400" />
      
      <div className="flex justify-start items-center space-x-4 p-4">
      {/* Phần Xem theo ngày */}
      <div className="flex items-center p-4 space-x-4">
      {/* Nút Xem theo ngày */}
      <div className="flex items-center">
        <span className="text-gray-500 mr-2">
          <i className="fas fa-calendar-alt"></i>
        </span>
        <span className="text-gray-700">Xem theo ngày</span>
      </div>

      {/* Lịch thả xuống */}
      <DatePicker
        selected={startDate}
        onChange={(date: any) => setStartDate(date)}
        dateFormat="dd/MM/yyyy"
        className="border p-2 rounded-md"
        showPopperArrow={false}
      />
    </div>

      {/* Phân trang */}
      <div className="flex space-x-2">
        <button
          onClick={() => handlePageChange(currentPage - 1)}
          disabled={currentPage === 1}
          className=" p-2 text-gray-700 hover:text-white hover:bg-gray-400 disabled:text-gray-300 disabled:bg-transparent"
        >
          &lt;
        </button>

        {[...Array(totalPages)].map((_, index) => (
          <button
            key={index}
            onClick={() => handlePageChange(index + 1)}
            className={`bg-[#992233] p-2 border rounded-md ${
              currentPage === index + 1 ? 'bg-red-600 text-white' : 'bg-transparent text-gray-700 hover:bg-gray-200'
            }`}
          >
            {index + 1}
          </button>
        ))}
        <button
          onClick={() => handlePageChange(currentPage + 1)}
          disabled={currentPage === totalPages}
          className="p-2 text-gray-700 hover:text-white hover:bg-gray-400 disabled:text-gray-300 disabled:bg-transparent"
        >
          &gt;
        </button>
      </div>
    </div>
    <div className="bg-gray-100 h-12 p-2">
  
</div>
    </div></>
  );
};

export default MainNews;
