import React, { useState, useEffect } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch, faUser, faMapMarkerAlt } from '@fortawesome/free-solid-svg-icons';
import { Link } from 'react-router-dom';

// API key từ OpenWeatherMap (bạn cần đăng ký tại https://openweathermap.org/api)
const API_KEY = 'YOUR_OPENWEATHERMAP_API_KEY';

const Navbar = () => {
  const [currentDate, setCurrentDate] = useState(new Date());
  const [weather, setWeather] = useState(null);
  const [searchQuery, setSearchQuery] = useState('');

  useEffect(() => {
    // Cập nhật thời gian mỗi giây
    const timer = setInterval(() => {
      setCurrentDate(new Date());
    }, 1000);

    // Lấy thông tin thời tiết
    fetchWeather();

    // Clear timer khi component bị unmount
    return () => clearInterval(timer);
  }, []);

  const fetchWeather = async () => {
    // Sử dụng OpenWeatherMap API để lấy thông tin thời tiết
    const city = 'Hanoi'; // Bạn có thể thay đổi tên thành phố hoặc sử dụng geolocation
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${API_KEY}`;

    try {
      const response = await fetch(url);
      const data = await response.json();
      if (data && data.weather && data.main) {
        setWeather({
          temp: data.main.temp,
          description: data.weather[0].description,
        });
      }
    } catch (error) {
      console.error('Lỗi khi lấy thông tin thời tiết:', error);
    }
  };

  const handleSearch = (e) => {
    e.preventDefault();
    // Xử lý tìm kiếm ở đây, có thể gọi API hoặc điều hướng đến trang kết quả tìm kiếm
    console.log('Tìm kiếm:', searchQuery);
  };

  return (
    <header className="d-flex justify-content-center align-items-center px-4 py-2 border-bottom" style={{ backgroundColor: '#f8f9fa' }}>
      <div className="d-flex align-items-center">
        {/* Phần Logo và Ngày tháng */}
        <img
          src="https://vnexpress.net/favicon.ico" // Logo của VNExpress
          alt="VNExpress Logo"
          style={{ height: '24px', marginRight: '10px' }}
        />
        <span className="font-weight-bold">VNEXPRESS</span>
        <span className="mx-3 text-muted">
          {currentDate.toLocaleDateString('vi-VN', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
          })},{' '}
          {currentDate.toLocaleTimeString('vi-VN')}
        </span>

        {/* Thông tin thời tiết */}
        {weather && (
          <span className="mx-3 text-muted">
            {weather.temp}°C, {weather.description}
          </span>
        )}

        {/* Các liên kết điều hướng */}
        <nav className="d-flex align-items-center">
          <a href="#newest" className="mx-3 text-muted text-decoration-none">Mới nhất</a>
          <a href="#regional" className="mx-3 text-muted text-decoration-none">
            <FontAwesomeIcon icon={faMapMarkerAlt} /> Tin theo khu vực
          </a>

          {/* Phần Tìm kiếm */}
          <div className="mx-3">
            <form onSubmit={handleSearch} className="d-flex align-items-center">
              <input
                type="text"
                className="form-control"
                placeholder="Tìm kiếm"
                value={searchQuery}
                onChange={(e) => setSearchQuery(e.target.value)}
              />
              <button type="submit" className="btn btn-outline-secondary ms-2">
                <FontAwesomeIcon icon={faSearch} />
              </button>
            </form>
          </div>

          {/* Đăng nhập */}
          <Link to='/login'>
          <a className="mx-3 text-muted text-decoration-none">
            <FontAwesomeIcon icon={faUser} /> Đăng nhập
          </a>
          </Link>
        </nav>
      </div>
    </header>
  );
};

export default Navbar;
