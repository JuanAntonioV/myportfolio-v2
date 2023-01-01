import { Fade } from "react-awesome-reveal";
import TitleSection from "./../title/SectionTitle";

const AboutSection = () => {
    const listStyle = {
        before: {
            content: "▹",
            position: "absolute",
            padingRight: "1rem",
            marginLeft: "-25px",
            color: "#61f9d5",
        },
    };

    return (
        <section id="about" className="my-32 md:my-48">
            <Fade direction="up" cascade damping={0.1} triggerOnce>
                <TitleSection title={"About Me"} line />

                <div className="grid grid-cols-1 lg:grid-cols-2">
                    <div className="order-2 py-6 text-lg tracking-wide text-justify text-secondary lg:order-1">
                        <p>
                            Hello! My name is Juan Antonio Vivaldy Saragih and I
                            enjoy creating things that live on the internet. My
                            interest in web development started back in 2017
                            when I decided to join the website club at my
                            highschool and make my own portfolio website with
                            HTML & CSS!
                        </p>

                        <p className="my-6">
                            Fast-forward to today, and I’ve had the privilege of
                            working at{" "}
                            <a href="#" className="textLink">
                                Brighton
                            </a>
                            ,{" "}
                            <a href="#" className="textLink">
                                Tokohardware
                            </a>
                            , and{" "}
                            <a href="#" className="textLink">
                                Dealjava
                            </a>
                            . My main focus these days is building accessible,
                            inclusive products and digital experiences.
                        </p>

                        <p>
                            I also recently{" "}
                            <a href="#" className="textLink">
                                launched a course
                            </a>{" "}
                            that covers everything you need to build a web app
                            using Node & React.
                        </p>

                        <div className="flex items-start pt-8 pl-6 text-sm font-sfmono">
                            <ul className="relative flex flex-col gap-3 skill-list">
                                <li>HTML5</li>
                                <li>CSS3</li>
                                <li>Javascript (ES6++)</li>
                            </ul>
                            <ul className="relative flex flex-col gap-3 pl-11 lg:pl-36 skill-list">
                                <li>Node JS</li>
                                <li>React JS</li>
                                <li>C#</li>
                            </ul>
                        </div>
                    </div>
                    <div className="order-1 lg:order-2">
                        <img
                            src="/assets/profile.jpeg"
                            alt="Profile"
                            className="w-[100%] lg:w-[80%] rounded-xl lg:rounded-3xl m-auto lg:hover:w-[81%] hover:shadow-xl duration-300 ease-in-out mb-8 lg:mb-0"
                        />
                    </div>
                </div>
            </Fade>
        </section>
    );
};

export default AboutSection;
