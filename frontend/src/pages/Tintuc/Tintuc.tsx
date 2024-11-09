import React, {useEffect, useState} from 'react'
import Footer from '../Footer'
import Navbar from '../Navbar'
import Header from '../Header'
import Banner from '../Banner'
import axios from 'axios'
import {useParams} from 'react-router-dom'

interface Post {
    id: string;
    name: string;
    tieude: string;
    location: string;
    content: string;
    category_id: string;
    slug: string;
    image: string; // giả định bạn có một thuộc tính hình ảnh
}

const Tintuc = () => {

    const [posts, setPosts] = useState<Post[]>([]);
    const {id_category} = useParams<{ id_category: string }>();
    const [loading, setLoading] = useState<boolean>(true);


    const getPostsById = async (id_category: string) => {
        // console.log(slug);
        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/post/${id_category}`);
            // console.log(response.data);
            setPosts(response.data.post);
            setLoading(false);
        } catch (error) {
            console.error("Error fetching post details:", error);
        }
    };

    useEffect(() => {
        if (id_category) {
            getPostsById(id_category);
        }
    }, [id_category]);
    return (
        <>
            <Banner/>
            <Navbar/>
            <Header/>

            <div className="container my-4">
                <div className="flex ">
                    {/* Main content */}
                    <div className="w-4/5">
                        {loading ? (
                            <p>Loading...</p> // Hiển thị thông báo loading
                        ) : (
                            posts.map((post) => (
                                <div className="mb-4">
                                    <div className="" key={post.id}>
                                        <a href={`/detail/${post.slug}`} className={"no-underline"}>
                                            <h3 className={"text-3xl text-black font-sans font-bold mb-2"}>{post.name}</h3>
                                            <img
                                                src={`http://127.0.0.1:8000/storage/${post.image}`}
                                                className={"w-full h-auto] me-2"}
                                                alt={post.id}
                                            />
                                            <p className={"mt-3 text-lg text-blue-500"}>Xem tin...</p>
                                        </a>
                                    </div>
                                </div>
                            ))
                        )}
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
