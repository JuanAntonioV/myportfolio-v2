import {Routes, Route} from "react-router-dom";

// Pages
import HomePage from "@/js/pages/HomePage";

const Router = () => {
    return (
        <Routes>
            <Route path="/" element={<HomePage/>}/>
        </Routes>
    );
};

export default Router;
