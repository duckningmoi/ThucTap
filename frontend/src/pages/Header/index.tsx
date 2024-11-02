import { HomeOutlined } from '@ant-design/icons';
import React from 'react';
import { Navbar, Nav,  } from 'react-bootstrap';

const Header = () => {
  return (
    <header>
      <Navbar />
      {/* Phần điều hướng trên cùng */}
      <Navbar bg="light" expand="lg" className="border-bottom">
        <div className="container">
          <Navbar.Brand href="/">
            
            
          </Navbar.Brand>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="mr-auto">
              <Nav.Link href="/"><HomeOutlined /></Nav.Link>
              <Nav.Link href="tintuc">Tin tức</Nav.Link>
              <Nav.Link href="#link">Tuyển sinh</Nav.Link>
              <Nav.Link href="#link">Chân dung</Nav.Link>
              <Nav.Link href="#link">Du học</Nav.Link>
              <Nav.Link href="#link">Thảo luận</Nav.Link>
              <Nav.Link href="#link">Học Tiếng Anh</Nav.Link>
              <Nav.Link href="#link">Giáo dục 4.0</Nav.Link>
            </Nav>
            
          </Navbar.Collapse>
        </div>
      </Navbar>

    </header>
  );
};

export default Header;
