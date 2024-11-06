import axios from 'axios';
import React, { useEffect, useState } from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';

interface Posts {
  _id: string;
  category_id: string;
  content: string;
  created_at: string;
  image: string;
  slug: string;
  name: string;
  view: string;
}

interface adds {
  _id: string;
  link_url: string;
  image: string;

}

const MainNews = () => {
  const [startDate, setStartDate] = useState(new Date());
  const [currentPage, setCurrentPage] = useState(1);
  const [lastPage, setLastPage] = useState(1);
  const [PostsHot, setPostsHot] = useState<Posts[]>([]);
  const [postHot3, setpostHot3] = useState<Posts[]>([]);
  const [postHot5, setpostHot5] = useState<Posts[]>([]);
  const [adds, setadds5] = useState<adds[]>([]);
  const [addsLeft, setaddsLeft] = useState<adds[]>([]);
  const [addsRight, setaddsRight] = useState<adds[]>([]);
  const [posts, setPosts] = useState<Posts[]>([]);


  const totalPages = 4;

  const handlePageChange = (page: any) => {
    if (page >= 1 && page <= totalPages) {
      setCurrentPage(page);
    }
  };
  const getPost = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/posts?page=${currentPage}`);
      setPostsHot(response.data.postHot);
      setpostHot3(response.data.postHot3);
      setpostHot5(response.data.postHot5);
      setadds5(response.data.adds);
      setaddsLeft(response.data.addsLeft);
      setaddsRight(response.data.addsRight);
      setPosts(response.data.post.data);
      setCurrentPage(response.data.post.current_page); // Cập nhật trang hiện tại
      setLastPage(response.data.post.last_page);
    } catch (error) {

    }
  };
  useEffect(() => {
    getPost();
  }, [currentPage]);
  console.log(posts);
  return (
    <><hr className="border-t-2 border-gray-300" /><div className="container mx-auto p-4 w-4/5">

      <a href={`/detail/${PostsHot.slug}`} className='no-underline'>
        <div className="w-5/10  grid grid-cols-2 gap-4 items-stretch w-4/5">
          {/* Hình ảnh tin tức */}
          <div>
            <img
              src={`http://127.0.0.1:8000/storage/${PostsHot.image}`}
              alt="Hiệu trưởng Y Hà Nội"
              className="w-full h-auto" />
          </div>

          {/* Nội dung tin tức với nền màu xám nhạt, cao bằng ảnh */}
          <div className="bg-gray-100 p-6 flex flex-col justify-center">
            <h2 className="text-3xl font-bold text-dark">
              {PostsHot.name}
            </h2>
            <p className="mt-4 text-gray-600">
              {PostsHot.content?.replace(/<\/?[^>]+(>|$)/g, "").split(" ").slice(0, 50).join(" ") + "..."}
            </p>
            <p className="mt-2 text-blue-600 font-semibold">Tin tức</p>
          </div>
        </div>
      </a>
      <hr className="border-t-2 border-gray-300" />

      <div className="grid grid-cols-3 gap-8 w-4/5">
        {postHot3.map((postHot3s) => (
          <a href={`/detail/${postHot3s.slug}`} className="no-underline" key={postHot3s._id}>
            <div>
              <h3 className="text-xl font-bold">
                {postHot3s.name}
              </h3>
              <p className="text-gray-600 mt-2">
                {postHot3s.content?.replace(/<\/?[^>]+(>|$)/g, "").split(" ").slice(0, 50).join(" ") + "..."}
              </p>
              <p className="text-gray-400 mt-4">Tin tức • 36</p>
            </div>
          </a>
        ))}
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
          {postHot5.map((postHot5s) => (
            <a href={`/detail/${postHot5s.slug}`} className="no-underline" key={postHot5s._id}>
              <div className="border-b pb-4 grid grid-cols-2 gap-4">
                <img
                  src={`http://127.0.0.1:8000/storage/${postHot5s.image}`}
                  alt="Học sinh THPT Lê Quý Đôn"
                  className="w-5/6 h-48 object-cover mb-2"
                />
                <div>
                  <h3 className="text-lg font-bold">
                    {postHot5s.name}
                  </h3>
                  <p className="text-gray-600">
                    {postHot5s.content?.replace(/<\/?[^>]+(>|$)/g, "").split(" ").slice(0, 30).join(" ") + "..."}
                  </p>
                </div>
              </div>
            </a>
          ))
          }
        </div>
        {/* Cột bên phải với các chủ đề nhỏ hơn */}
        <div className="space-y-4">
          {adds.map((adds) => (
            <a href={adds.link_url} className="no-underline" key={adds._id}>
              <div className="bg-gray-100 p-4">
                <img
                  src={`http://127.0.0.1:8000/storage/${adds.image}`}
                  alt="Du học"
                  className="w-full h-auto object-cover mb-2"
                />
                <p className="text-gray-600">
                  {adds.vitri}
                </p>
              </div>
            </a>
          ))

          }
          <hr className="border-t-2 border-gray-300" />
        </div>
      </div>
      <hr className="border-t-2 border-gray-300" />
      <hr className="border-t-2 border-gray-300" />


      <div className="grid grid-cols-8 gap-6">
        {/* Cột bên trái (2 phần) */}
        <div className="col-span-2 space-y-6">
          {addsLeft.map((addsLefts) => (
            <a href={addsLefts.link_url} className="no-underline" key={addsLefts._id}>
              <div className="bg-gray-100 p-4">
                <h3 className="text-lg font-bold">{addsLefts.vitri}</h3>
                <img
                  src={`http://127.0.0.1:8000/storage/${addsLefts.image}`}
                  alt="Trường DH FPT"
                  className="w-full h-auto object-cover"
                />
              </div>
            </a>
          ))
          }


        </div>

        {/* Cột giữa (4 phần) */}
        <div className="col-span-4 space-y-6">
         {posts.map((postss) => (
          <div className="border-b pb-4 grid grid-cols-2 gap-4">
            <img
               src={`http://127.0.0.1:8000/storage/${postss.image}`}
              alt="Trường DH FPT"
              className="w-full h-auto object-cover"
            />
            <div>
              <h3 className="text-lg font-bold">
               {postss.name}
              </h3>
              <p className="text-gray-600">
              {postss.content?.replace(/<\/?[^>]+(>|$)/g, "").split(" ").slice(0, 50).join(" ") + "..."}
              </p>
            </div>
          </div>
         ))

}

          {/* <div className="border-b pb-4 grid grid-cols-2 gap-4">
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
          </div> */}
        </div>

        {/* Cột bên phải (2 phần) */}
        <div className="col-span-2 space-y-6">
          <div className="bg-gray-100 shadow-md rounded-lg overflow-hidden">
            {addsRight.map((addsRights) => (
              <a href={addsRights.link_url} className="no-underline" key={addsRights._id}>
                <div className="bg-gray-100 p-4">
                  <h3 className="text-lg font-bold">{addsRights.vitri}</h3>
                  <img
                    src={`http://127.0.0.1:8000/storage/${addsRights.image}`}
                    alt="Trường DH FPT"
                    className="w-full h-auto object-cover"
                  />
                </div>
              </a>
            ))
            }
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
              className={`bg-[#992233] p-2 border rounded-md ${currentPage === index + 1 ? 'bg-red-600 text-white' : 'bg-transparent text-gray-700 hover:bg-gray-200'
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
