import HeroSection from "../components/sections/HeroSection";

const HomePage = () => {
    return (
        <div className={"px-6 md:px-44 w-full"}>
            <HeroSection />

            <section id="about">
                <div className="mt-80 h-screen">Section 1</div>
            </section>
        </div>
    );
};

export default HomePage;
