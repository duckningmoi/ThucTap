import React, {useState, useEffect} from 'react';
import {FontAwesomeIcon} from '@fortawesome/react-fontawesome';
import {faSearch, faUser, faMapMarkerAlt} from '@fortawesome/free-solid-svg-icons';
import {Link, useNavigate} from 'react-router-dom';

interface Weather {
    temp: number;
    description: string;
}

// API key từ OpenWeatherMap (bạn cần đăng ký tại https://openweathermap.org/api)
const API_KEY = 'YOUR_REAL_API_KEY_HERE';

const Navbar = () => {
    const [currentDate, setCurrentDate] = useState(new Date());
    const [weather, setWeather] = useState<Weather | null>(null);
    const [searchQuery, setSearchQuery] = useState('');
    const navigate = useNavigate();

    const handleSearch = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        navigate(`/search?keyword=${searchQuery}`);
    };

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
        const city = 'Hanoi';
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${API_KEY}`;

        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
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

    return (
        <header className="pb-2.5 border-bottom">
            <div className={"px-5 w-full flex justify-between items-center"}>
                <div className={"flex items-end"}>
                    <img
                        src="/logo.png"
                        alt="WS Logo"
                        className={"h-10 w-10 mx-auto object-cover"}
                    />
                    <span className="font-bold font-serif text-gray-700 text-3xl">World<span
                        className={"text-blue-500"}>Schools</span></span>
                </div>
                <div className={"flex justify-start items-center"}>
                    {/* Phần Logo và Ngày tháng */}
                    <span className="me-5 text-muted italic">
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
                        <span className="mx-3 text-muted">{weather.temp}°C, {weather.description}</span>
                    )}
                    <a href="#newest" className="mx-2 text-base font-semibold hover:font-bold text-muted text-decoration-none">Mới nhất</a>
                    <a href="#regional" className="mx-2 hover:font-bold text-base text-muted text-decoration-none font-semibold">
                        <FontAwesomeIcon icon={faMapMarkerAlt} className={"text-red-600 text-lg"}/> Tin theo khu vực
                    </a>
                </div>

                <div className={"flex justify-end items-center"}>
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
                            <button type="submit" className="btn btn-outline-primary ms-1">
                                <FontAwesomeIcon icon={faSearch}/>
                            </button>
                        </form>
                    </div>

                    {/* Đăng nhập */}
                    <Link to='/login' className="ms-4 font-semibold hover:font-bold text-lg text-muted text-decoration-none">
                        <FontAwesomeIcon icon={faUser} className={"text-lg me-1"}/> Đăng nhập
                    </Link>
                </div>
            </div>
        </header>
    );
};

export default Navbar;
