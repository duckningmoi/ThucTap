import axios from 'axios';
import React, {useEffect, useState} from 'react';
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
        <div className={"px-36"}>
            <div className="p-3">
                <a href={`/detail/${PostsHot.slug}`} className='no-underline'>
                    <div className="grid grid-cols-2 gap-4 items-stretch">
                        {/* Hình ảnh tin tức */}
                        <div>
                            <img
                                src={`http://127.0.0.1:8000/storage/${PostsHot.image}`}
                                alt="hotNews"
                                className="w-full h-auto"/>
                        </div>

                        {/* Nội dung tin tức với nền màu xám nhạt, cao bằng ảnh */}
                        <div className="bg-gray-100 p-6 flex flex-col">
                            <h2 className="text-3xl font-bold text-dark">
                                {PostsHot.name}
                            </h2>
                            <p className="mt-4 text-gray-600">
                                {PostsHot.content?.replace(/<\/?[^>]+(>|$)/g, "").split(" ").slice(0, 100).join(" ") + "..."}
                            </p>
                            <span className="mt-2 text-blue-600 font-semibold hover:font-bold">Tin tức</span>
                        </div>
                    </div>
                </a>

                <div className="grid grid-cols-3 gap-8 mt-4">
                    {postHot3.map((postHot3s) => (
                        <a href={`/detail/${postHot3s.slug}`} className="no-underline" key={postHot3s._id}>
                            <div>
                                <h3 className="text-xl font-semibold hover:font-bold">
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

                <div className="flex space-x-8 mt-2 mb-4 text-pink-600">
                    <a href="#" className="no-underline hover:underline hover:text-red-600 text-blue-500">
                        Tuyển sinh đại học 2025
                    </a>
                    <a href="#" className="no-underline hover:underline hover:text-red-600 text-blue-500">
                        Du học Mỹ
                    </a>
                    <a href="#" className="no-underline hover:underline hover:text-red-600 text-blue-500">
                        Thi lớp 10 năm 2025
                    </a>
                </div>
                {/* Lưới tin tức */}
                <div className="grid grid-cols-3 gap-6">
                    {/* Cột chính với các tin lớn */}
                    <div className="col-span-2 space-y-4">
                        {postHot5.map((postHot5s) => (
                            <a href={`/detail/${postHot5s.slug}`} className="no-underline" key={postHot5s._id}>
                                <div className="pb-4 grid grid-cols-2 gap-4">
                                    <img
                                        src={`http://127.0.0.1:8000/storage/${postHot5s.image}`}
                                        alt="Học sinh THPT Lê Quý Đôn"
                                        className="w-full h-56 object-cover mb-2"
                                    />
                                    <div className={"flex flex-col justify-between"}>
                                        <div>
                                            <h3 className="text-lg font-bold">
                                                {postHot5s.name}
                                            </h3>
                                            <p className="text-gray-600">
                                                {postHot5s.content?.replace(/<\/?[^>]+(>|$)/g, "").split(" ").slice(0, 45).join(" ") + "..."}
                                            </p>
                                        </div>
                                        <span>Xem thêm...</span>
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
                                <div className="ms-5">
                                    <img
                                        src={`http://127.0.0.1:8000/storage/${adds.image}`}
                                        alt="Du học"
                                        className="w-full h-48 object-cover mb-2"
                                    />
                                    <p className="text-gray-600">
                                        {adds.vitri}
                                    </p>
                                </div>
                            </a>
                        ))
                        }
                    </div>
                </div>

                <div className="grid grid-cols-9 gap-4">
                    {/* Cột bên trái (2 phần) */}
                    <div className="col-span-2 space-y-6">
                        {addsLeft.map((addsLefts) => (
                            <a href={addsLefts.link_url} className="no-underline" key={addsLefts._id}>
                                <div className="">
                                    <img
                                        src={`http://127.0.0.1:8000/storage/${addsLefts.image}`}
                                        alt="Trường DH FPT"
                                        className="w-full h-36 object-cover"
                                    />
                                    <h3 className="text-lg font-bold">{addsLefts.vitri}</h3>
                                </div>
                            </a>
                        ))
                        }
                    </div>

                    {/* Cột giữa (4 phần) */}
                    <div className="col-span-5 space-y-6 mx-3">
                        {posts.map((postss) => (
                            <div className="border-b pb-3 hover:italic grid grid-cols-2 gap-4">
                                <img
                                    src={`http://127.0.0.1:8000/storage/${postss.image}`}
                                    alt="Trường DH FPT"
                                    className="w-full h-56 object-cover"
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
                    </div>

                    {/* Cột bên phải (2 phần) */}
                    <div className="col-span-2 space-y-6">
                        <div className="shadow-md rounded-lg overflow-hidden">
                            {addsRight.map((addsRights) => (
                                <a href={addsRights.link_url} className="no-underline" key={addsRights._id}>
                                    <div>
                                        <img
                                            src={`http://127.0.0.1:8000/storage/${addsRights.image}`}
                                            alt="Trường DH FPT"
                                            className="w-full h-48 object-cover"
                                        />
                                        <h3 className="text-lg font-bold m-2">{addsRights.vitri}</h3>
                                    </div>
                                </a>
                            ))
                            }
                        </div>
                    </div>

                </div>

                <div className="flex justify-between items-center border-t space-x-4 mt-5 py-4">
                    {/* Phần Xem theo ngày */}
                    <div className="flex items-center w-auto space-x-2">
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
                            showPopperArrow={false}/>
                    </div>

                    {/* Phân trang */}
                    <div className="flex w-auto space-x-2">
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
                    <span></span>
                </div>
            </div>
        </div>
    );
};

export default MainNews;
