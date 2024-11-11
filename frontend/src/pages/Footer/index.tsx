import React from 'react';

const Footer = () => {
    return (
        <footer className="bg-light text-dark pt-4 border-top">
            <div className="container">
                <div className="row">
                    <div className="flex items-end mb-3">
                        <img
                            src="/logo.png"
                            alt="VNExpress Logo"
                            className="mr-2 h-10 w-10"
                        />
                        <span className={"text-lg font-serif font-semibold"}>WorldSchools</span>
                    </div>
                    <div className="col-md-4 d-flex flex-column">


                        <div>
                            Website tin tức giáo dục <br/>
                            Thuộc Bộ Khoa học và Công nghệ <br/>
                            Số giấy phép: 548/GP-BTTTT do Bộ Thông tin và Truyền thông cấp ngày 24/08/2021
                        </div>
                    </div>

                    {/* Thông tin liên hệ và điều khoản */}
                    <div className="col-md-4 d-flex flex-column">

                        <div className={"font-bold"}>
                            Địa
                            chỉ: <span className={"text-blue-500 font-semibold"}>Cao đẳng FPT Polytechnic, Trịnh Văn Bô, Phương Canh, Nam Từ Liêm, Hà Nội</span>
                            <br/>
                            Điện thoại: <span className={"text-blue-500 font-semibold"}>024 7300 8899</span> <br/>
                            Email: <span className={"text-blue-500 font-semibold"}>webmaster@ws.net</span>
                        </div>
                    </div>
                    <div className="col-md-4 d-flex flex-column">
                        <span>© 2024 - Toàn bộ bản quyền thuộc WorldSchools.</span>
                    </div>
                </div>


            </div>
        </footer>
    );
};

export default Footer;
