import React, {useState} from 'react';
import {Button, Input, Checkbox, message} from 'antd';
import {MailOutlined, LockOutlined, EyeInvisibleOutlined, EyeTwoTone} from '@ant-design/icons';
import {useNavigate} from 'react-router-dom';
import axios, {AxiosError} from 'axios';

interface ErrorResponse {
    errors: {
        email?: string[];
        password?: string[];
    };
}

const Login: React.FC = () => {
    const [email, setEmail] = useState<string>('');
    const [password, setPassword] = useState<string>('');
    const [rememberMe, setRememberMe] = useState<boolean>(false);
    const [emailError, setEmailError] = useState<string>('');
    const [passwordError, setPasswordError] = useState<string>('');

    const navigate = useNavigate();

    const validateEmail = (email: string): boolean => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };


    const handleLogin = async () => {
        let valid = true;

        // Reset errors
        setEmailError('');
        setPasswordError('');

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

        try {
            const response = await axios.post('http://localhost:8000/api/login', {
                email,
                password,
            });

            const {token, user, message: successMessage} = response.data;

            message.success(successMessage);

            // Store token and user info if "Remember Me" is checked
            if (rememberMe) {
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user));
            }

            // Redirect to homepage
            navigate('/');
        } catch (error) {
            // Typecast error as AxiosError
            const err = error as AxiosError<ErrorResponse>;

            if (err.response && err.response.status === 422) {
                const errors = err.response.data.errors;
                if (errors.email) setEmailError(errors.email[0]);
                if (errors.password) setPasswordError(errors.password[0]);
            } else {
                message.error('Đăng nhập không thành công. Vui lòng thử lại.');
            }

        }
    };

    return (
        <div className={"h-screen w-screen flex justify-center items-center bg-blue-100"}>
            <div className="login-container">
                <h2>Đăng nhập</h2>

                <Input
                    size="large"
                    placeholder="Email"
                    prefix={<MailOutlined/>}
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    className="input-field"
                />
                {emailError &&
                    <div className="error-message" style={{color: "red", textAlign: "left"}}>{emailError}</div>}

                <Input.Password
                    size="large"
                    placeholder="Mật khẩu"
                    prefix={<LockOutlined/>}
                    iconRender={(visible) => (visible ? <EyeTwoTone/> : <EyeInvisibleOutlined/>)}
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    className="input-field"
                />
                {passwordError &&
                    <div className="error-message" style={{color: "red", textAlign: "left"}}>{passwordError}</div>}

                <div className="remember-section">
                    <Checkbox
                        checked={rememberMe}
                        onChange={() => setRememberMe(!rememberMe)}
                        className="remember-checkbox"
                    >
                        Nhớ đăng nhập
                    </Checkbox>
                    <a href="/forgot-password" className="forgot-password-link">
                        Quên mật khẩu?
                    </a>
                </div>

                <Button type="primary" block onClick={handleLogin} className="login-btn">
                    Login
                </Button>

                <div className="policy-section">
                    <p>
                        Bằng cách đăng ký, bạn đồng ý với <a href="/terms">Điều khoản dịch vụ</a> và <a href="/privacy">Chính
                        sách quyền riêng tư</a>, bao gồm <a href="/cookies">việc sử dụng cookie</a>.
                    </p>
                </div>

                <div className="footer">
                    <span className={"text-base italic"}>Chưa có tài khoản? <a
                        className={"ms-2 font-semibold not-italic no-underline hover:font-bold"} href="/register">Đăng Ký</a></span>
                </div>
            </div>
        </div>
    );
};

export default Login;
