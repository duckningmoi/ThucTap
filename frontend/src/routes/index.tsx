
import Login from '@/pages/Account/Login';
import Register from '@/pages/Account/Register';
import NewsLayout from '@/pages/Detail/Detail';
import Layouttintuc from '@/pages/Layout/LayOuttintuc';
import Tintuc from '@/pages/Tintuc/Tintuc';

import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';


const Routers= () => {
    return (
        <Routes>
        <Route path="/" element={<Layouttintuc />} ></Route>
        <Route path="/tintuc" element={<Tintuc />} ></Route>
        <Route path="/detail/:slug" element={<NewsLayout />} ></Route>
        <Route path="/register" element={<Register />} ></Route>
        <Route path="/login" element={<Login />} ></Route>


    </Routes>
    );
};

export default Routers;