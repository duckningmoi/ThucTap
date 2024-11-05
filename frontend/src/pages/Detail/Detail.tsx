import React, { useEffect, useState } from 'react';
import Footer from '../Footer';
import Navbar from '../Navbar';
import Header from '../Header';
import Banner from '../Banner';
import { ArrowLeftOutlined } from '@ant-design/icons';
import { Flex, Input, message } from 'antd';
import axios from 'axios';
import { useParams } from 'react-router-dom';

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

const NewsLayout = () => {
  const { TextArea } = Input;
  const { slug } = useParams<{ slug: string }>();
  const [posts, setDetail] = useState<Posts | null>(null);
  const [postsCategory, setDetailCategory] = useState<Posts[]>([]);
  const [postView, setDetailView] = useState<Posts[]>([]);
  const token = localStorage.getItem('token');


  const [addComment, setAddComment] = useState({
    content: '',
    slug: '',
    user_id: '',
  });

  const user = JSON.parse(localStorage.getItem('user'));

  if (user && user._id && user._id.$oid) {
    addComment.user_id = user._id.$oid; // Truy cập vào $oid
    console.log("User ID:", addComment.user_id);
  } else {
    console.log("Người dùng chưa được lưu.");
  }



  const getPostsById = async (slug: string) => {
    // console.log(slug);
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/postDetail/${slug}`);
      // console.log(response.data);
      setDetail(response.data.post);
      setDetailCategory(response.data.post_category);
      setDetailView(response.data.postView);
    } catch (error) {
      console.error("Error fetching post details:", error);
    }
  };

  useEffect(() => {
    // console.log("Slug:", slug); 
    if (slug) {
      getPostsById(slug);
    }
  }, [slug]);
  // bình luận 
  const handleChangeComment = (e) => {
    const { name, value } = e.target;
    setAddComment((prev) => ({
      ...prev,
      [name]: value,
    }));
  };
  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!user) {
      console.log('Bạn cần phải đăng nhập');
      nav('/login');
      return;
    }

    try {
      const response = await axios.post(`http://127.0.0.1:8000/api/comments/${slug}`, {
        content: addComment.content,
        user_id: addComment.user_id,
      });
      console.log('Bình luận đã được gửi:', response.data);
      setAddComment({ content: '', slug: '', user_id: addComment.user_id });
    } catch (error) {
      console.error("Lỗi khi gửi bình luận:", error);
    }
  }
  // console.log(posts);
  // console.log(postsCategory);
  // console.log(postView);



  return (
    <>
      <Navbar />
      <Header />
      <Banner />
      <div className="container my-4 news-container">
        <div className="main-content">
          <div className="news-content">
            <div className="section">
              <h1>{posts ? posts.name : 'Loading...'}</h1>
              <p dangerouslySetInnerHTML={{ __html: posts ? posts.content : 'Loading content...' }} />
            </div>
          </div>
          <div className='back-icon'>
            <button><ArrowLeftOutlined /></button>
          </div>
          <div className='binhluan'>
            <h2>Bình luận</h2>
           
                <form onSubmit={handleSubmit}>
                  <div className="input">
                    <div style={{ display: 'flex', flexDirection: 'column', gap: '32px' }}>
                      <input
                        type="text"
                        maxLength={50}
                        name="content"
                        className="border-2 border-black rounded-lg p-2"
                        placeholder="Add your comment here"
                        onChange={handleChangeComment}
                        value={addComment.content}
                      />
                      <input type="hidden" name="user_id" value={addComment.user_id}
                        onChange={handleChangeComment}
                      />
                    </div>
                  </div>
                  <button type="submit">Gửi</button>
                </form>
          </div>
        </div>

        {/* Sidebar content */}
        <div className="news-sidebar">
          <div>
            <h3>Xem nhiều</h3>
            <ul>
              {postView.map((postViews) => (
                <li>
                  <a href={`/detail/${postViews.slug}`}>{postViews.name}</a>
                  <span>{postViews.view}</span>
                </li>
              ))}


            </ul>
          </div>
          <div className="lienquan">
            <div className="lq-item">
              <div className="lq-item-content">
                <h3>Liên quan</h3>
                <ul>
                  {postsCategory.map((postsCategorys) => (
                    <li>
                      <img
                        src={`http://127.0.0.1:8000/storage/${postsCategorys.image}`}
                        alt="Sinh viên Bách khoa ăn cơm"
                      />
                      <p>
                        <a href={`/detail/${postsCategorys.slug}`}> {postsCategorys.name}</a>
                      </p>
                    </li>
                  ))

                  }


                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default NewsLayout;
