import Banner from '@/pages/Banner';
import Footer from '@/pages/Footer';
import Header from '@/pages/Header';
import { Outlet } from 'react-router-dom';
import EducationNews from '../Layoutnoidung';
import Navbar from '@/pages/Navbar';


const Layouttintuc = () => {
    return (
        <div>
            <Banner />
            <Navbar />
            <Header />
            <EducationNews />
            <Outlet />
            <Footer />
        </div>
    );
};

export default Layouttintuc ;
