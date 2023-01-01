import AboutSection from "../components/sections/AboutSection";
import ExperienceSection from "../components/sections/ExperienceSection";
import HeroSection from "../components/sections/HeroSection";

const HomePage = () => {
    return (
        <div className={"px-6 md:px-44 w-full"}>
            <HeroSection />
            <AboutSection />
            <ExperienceSection />
        </div>
    );
};

export default HomePage;
