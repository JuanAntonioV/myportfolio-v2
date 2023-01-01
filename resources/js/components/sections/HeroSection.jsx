import { Fade } from "react-awesome-reveal";
const HeroSection = () => {
    return (
        <section className="mt-32 md:mt-44" id="home">
            <Fade direction="up" triggerOnce>
                <h1 className="text-base text-center textHighlight md:text-left md:text-base md:py-6">
                    Hi, my name is
                </h1>
            </Fade>

            <Fade direction="up" cascade damping={0.1} triggerOnce>
                <h2 className="mt-3 text-center md:mt-2 textDisplay md:text-7xl md:text-left text-primary">
                    Juan Antonio Vivaldy.
                </h2>
                <h3 className="mt-5 text-center md:mt-5 textDisplay font-calibre md:text-left md:text-7xl text-secondary">
                    I build things for the web.
                </h3>
            </Fade>

            <Fade direction="up" cascade triggerOnce>
                <p className="pt-3 text-base text-center text-primary text-desc md:text-xl md:text-left">
                    I'm a Front End Developer & UX Design specializing in
                    building (occasionally designing) exceptional digital
                    experiences.
                </p>
            </Fade>

            <Fade direction="up" className="mt-0 md:mt-2" triggerOnce>
                <button className="w-full text-base btnTertinary md:w-auto mt-14">
                    Get In Touch
                </button>
            </Fade>
        </section>
    );
};

export default HeroSection;
