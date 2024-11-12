import { Category, fetchCategorys } from '@/interface/Product';
import { HomeOutlined } from '@ant-design/icons';
import React, { useEffect, useState } from 'react';
import { Navbar, Nav } from 'react-bootstrap';
import { NavLink } from 'react-router-dom';

const Header: React.FC = () => {
  const [categories, setCategories] = useState<Category[]>([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const data = await fetchCategorys(); // Gọi hàm `fetchCategorys` để lấy danh mục
        console.log(data); // Kiểm tra cấu trúc dữ liệu
        if (Array.isArray(data.category)) { // Kiểm tra thuộc tính category
          setCategories(data.category); // Gán giá trị từ data.category
        } else {
          console.error('Dữ liệu không phải là mảng:', data.category);
          setCategories([]);
        }
      } catch (error) {
        console.error('Lỗi khi lấy danh mục:', error);
      }
    };

    fetchData();
  }, []);

  return (
    <header>
      <Navbar bg="light" expand="lg" className="border-bottom">
        <div className="container">
          <Navbar.Brand href="/">
            {/* Logo hoặc tên thương hiệu */}
          </Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="mr-auto flex items-center">
              <Nav.Link href="/" className="no-underline hover:no-underline text-dark">
                <span className={"font-bold text-lg"}>Trang chủ</span>
              </Nav.Link>
              {categories.map((category) => (
                <NavLink
                  key={category.id}
                  to={`/post/${category._id.$oid}`}
                  className="no-underline hover:underline text-dark"
                >
                  {category.name}
                </NavLink>
              ))}
            </Nav>
          </Navbar.Collapse>
        </div>
      </Navbar>
    </header>
  );
};

export default Header;
