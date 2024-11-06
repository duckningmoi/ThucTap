import { Category, fetchCategorys } from '@/interface/Product';
import { HomeOutlined } from '@ant-design/icons';
import React, { useEffect, useState } from 'react';
import { Navbar, Nav } from 'react-bootstrap';
import { Link } from 'react-router-dom';

const Header = () => {
  const [categories, setCategories] = useState<Category[]>([]);
  const [loading, setLoading] = useState<boolean>(true);

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
      } finally {
        setLoading(false); // Đặt loading là false sau khi hoàn tất
      }
    };

    fetchData();
  }, []);

  return (
    <header>
      <Navbar />
      <Navbar bg="light" expand="lg" className="border-bottom">
        <div className="container">
          <Navbar.Brand href="/">
            {/* Logo hoặc tên thương hiệu */}
          </Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="mr-auto">
              <Nav.Link href="/"><HomeOutlined /></Nav.Link>
              {loading ? (
                <Nav.Link disabled>Loading...</Nav.Link> // Hoặc hiển thị spinner
              ) : (
                categories.map((category) => (
                  <Nav.Link key={category.id} >
                    {category.name}
                  </Nav.Link>
                ))
              )}
            </Nav>
          </Navbar.Collapse>
        </div>
      </Navbar>
    </header>
  );
};

export default Header;
