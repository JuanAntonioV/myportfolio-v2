import Router from "@/js/router/Router";
import SocialMediaSticky from "@/js/components/features/SocialMediaSticky";
import EmailSticky from "@/js/components/features/EmailSticky";
import MainNavbar from "../components/navbar/MainNavbar";

const App = () => {
    return (
        <>
            <MainNavbar />
            <SocialMediaSticky />
            <Router />
            <EmailSticky />
        </>
    );
};

export default App;
