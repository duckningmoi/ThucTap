import React, { useState, useEffect } from 'react';
import { Input, Card } from 'antd';
import axios from 'axios';
import { useNavigate, useLocation } from 'react-router-dom';
import Navbar from '../Navbar';
import Header from '../Header';
import Banner from '../Banner';
import Footer from '../Footer';

interface Post {
  _id: string;
  name: string;
  image: string;
  content: string;
  location: string;
  category_id: string;
}

const Search: React.FC = () => {
  const [searchQuery, setSearchQuery] = useState('');
  const [searchResults, setSearchResults] = useState<Post[]>([]);
  const navigate = useNavigate();
  const location = useLocation();

  // Lấy từ khóa từ URL khi component được tải
  useEffect(() => {
    const params = new URLSearchParams(location.search);
    const keyword = params.get('keyword') || '';
    setSearchQuery(keyword);
    if (keyword) {
      handleSearch(keyword);
    }
  }, [location.search]);

  // Hàm tìm kiếm
  const handleSearch = async (query: string) => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/search-posts?keyword=${query}`);
      setSearchResults(response.data); // Lưu kết quả tìm kiếm
    } catch (error) {
      console.error('Lỗi khi gọi API tìm kiếm:', error);
    }
  };

  // Hàm xử lý khi nhấn "Tìm" trong ô tìm kiếm
  const onSearch = (value: string) => {
    navigate(`/search?keyword=${encodeURIComponent(value)}`); // Cập nhật URL với từ khóa
    handleSearch(value); // Thực hiện tìm kiếm ngay lập tức
  };

  return (
    <>
      <Banner />
      <Navbar />
      <Header />
    
      <div className="container my-4">
        <div className="search-page">
          <h2>Tìm kiếm</h2>
          <Input.Search
            placeholder="Tìm kiếm"
            enterButton="Tìm"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            onSearch={onSearch} // Gọi onSearch khi nhấn "Tìm"
            style={{ marginBottom: '20px' }}
          />

          <div className="search-results">
            {searchResults.length > 0 ? (
              searchResults.map((post) => (
                 <div className="news-articles">
          <div className="news-item" key={post._id}>
            
            <div className="news-item-content">
              <h3>{post.name}</h3>
              <p>
                {post.content}
              </p>
            </div>
            <img src={post.image} alt={post.name} />
          </div>

          
        </div>
              ))
            ) : (
              <p>Không có kết quả nào.</p>
            )}
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default Search;
