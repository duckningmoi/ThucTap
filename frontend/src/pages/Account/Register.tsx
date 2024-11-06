import React, { useState } from 'react';
import axios, { AxiosError } from 'axios';
import { Button, Input, message } from 'antd';
import { MailOutlined, LockOutlined, EyeInvisibleOutlined, EyeTwoTone, UserOutlined } from '@ant-design/icons';
import { useNavigate } from 'react-router-dom';
import { GoogleOAuthProvider, GoogleLogin } from '@react-oauth/google';

const Register: React.FC = () => {
  const [email, setEmail] = useState<string>('');
  const [name, setName] = useState<string>('');
  const [password, setPassword] = useState<string>('');
  const [confirmPassword, setConfirmPassword] = useState<string>('');
  const [emailError, setEmailError] = useState<string>('');
  const [nameError, setNameError] = useState<string>('');
  const [passwordError, setPasswordError] = useState<string>('');
  const [confirmPasswordError, setConfirmPasswordError] = useState<string>('');

  const navigate = useNavigate();

  const validateEmail = (email: string): boolean => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  };

  const handleRegister = async () => {
    let valid = true;

    // Reset errors
    setNameError('');
    setEmailError('');
    setPasswordError('');
    setConfirmPasswordError('');

    // Kiểm tra tên
    if (!name) {
      setNameError('Vui lòng nhập tên.');
      valid = false;
    }

    // Kiểm tra email
    if (!email) {
      setEmailError('Vui lòng nhập email.');
      valid = false;
    } else if (!validateEmail(email)) {
      setEmailError('Email không hợp lệ.');
      valid = false;
    }

    // Kiểm tra mật khẩu
    if (!password) {
      setPasswordError('Vui lòng nhập mật khẩu.');
      valid = false;
    } else if (password.length < 6) {
      setPasswordError('Mật khẩu phải có ít nhất 6 ký tự.');
      valid = false;
    }

    // Kiểm tra xác nhận mật khẩu
    if (!confirmPassword) {
      setConfirmPasswordError('Vui lòng nhập lại mật khẩu.');
      valid = false;
    } else if (password !== confirmPassword) {
      setConfirmPasswordError('Mật khẩu nhập lại không khớp.');
      valid = false;
    }

    if (valid) {
      try {
        const response = await axios.post('http://localhost:8000/api/register', {
          name, // Thêm trường 'name' nếu cần
          email,
          password,
        });

        const { token, user, message: successMessage } = response.data;
        message.success(successMessage);

        // Lưu token và thông tin người dùng vào localStorage
        localStorage.setItem('token', token);
        localStorage.setItem('user', JSON.stringify(user));

        // Chuyển hướng đến trang đăng nhập
        navigate('/login');
      } catch (error) {
        const err = error as AxiosError<{ errors: { name?: string[]; email?: string[]; password?: string[] } }>;

        if (err.response && err.response.data.errors) {
          const errors = err.response.data.errors;
          if (errors.name) setNameError(errors.name[0]);
          if (errors.email) setEmailError(errors.email[0]);
          if (errors.password) setPasswordError(errors.password[0]);
        } else {
          message.error('Đăng ký không thành công. Vui lòng thử lại.');
        }
      }
    }
  };

  const handleGoogleSuccess = async (response: any) => {
    try {
      const googleToken = response.credential;
      const res = await axios.post('http://localhost:8000/auth/google', { token: googleToken });
      
      const { token, user, message: successMessage } = res.data;
      message.success(successMessage);

      localStorage.setItem('token', token);
      localStorage.setItem('user', JSON.stringify(user));
      
      navigate('/login');
    } catch (error) {
      message.error('Đăng ký bằng Google không thành công. Vui lòng thử lại.');
    }
  };

  const handleGoogleFailure = () => {
    message.error('Đăng ký bằng Google thất bại.');
  };

  return (
    <GoogleOAuthProvider clientId="311724826104-v19b2fi0tu7nc0i6j7inaoaqqrj5tpts.apps.googleusercontent.com">
    <div className="register-container">
      <h2>Đăng ký</h2>

      <GoogleLogin
  onSuccess={handleGoogleSuccess}
  onError={handleGoogleFailure}
  containerProps={{
    style: { display: 'flex', alignItems: 'center', justifyContent: 'center' },
    className: 'google-login-container'
  }}
/>

      <Input
        size="large"
        placeholder="Name"
        prefix={<UserOutlined />}
        value={name}
        onChange={(e) => setName(e.target.value)}
        className="input-field"
      />
      {nameError && <div className="error-message" style={{color: "red", textAlign: "left"}}>{nameError}</div>}

      <Input
        size="large"
        placeholder="Email"
        prefix={<MailOutlined />}
        value={email}
        onChange={(e) => setEmail(e.target.value)}
        className="input-field"
      />
      {emailError && <div className="error-message" style={{color: "red", textAlign: "left"}}>{emailError}</div>}

      <Input.Password
        size="large"
        placeholder="Mật khẩu"
        prefix={<LockOutlined />}
        iconRender={visible => (visible ? <EyeTwoTone /> : <EyeInvisibleOutlined />)}
        value={password}
        onChange={(e) => setPassword(e.target.value)}
        className="input-field"
      />
      {passwordError && <div className="error-message" style={{color: "red", textAlign: "left"}}>{passwordError}</div>}

      <Input.Password
        size="large"
        placeholder="Nhập lại mật khẩu"
        prefix={<LockOutlined />}
        iconRender={visible => (visible ? <EyeTwoTone /> : <EyeInvisibleOutlined />)}
        value={confirmPassword}
        onChange={(e) => setConfirmPassword(e.target.value)}
        className="input-field"
      />
      {confirmPasswordError && <div className="error-message" style={{color: "red", textAlign: "left"}}>{confirmPasswordError}</div>}

      <Button type="primary" block onClick={handleRegister} className="register-btn">
        Đăng ký
      </Button>

      
      <div className="footer">
        <span>Đã có tài khoản? <a href="/login">Đăng nhập</a></span>
      </div>
    </div>
    </GoogleOAuthProvider>
  );
};

export default Register;
