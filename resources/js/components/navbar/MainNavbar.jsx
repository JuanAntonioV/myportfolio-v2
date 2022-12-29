import { Fade } from "react-awesome-reveal";
import useToggle from "./../../hooks/useToggle";
import { useEffect, useRef, useState } from "react";

const MainNavbar = () => {
    const navbarRef = useRef(null);
    const [show, toggle] = useToggle(false);

    const navLinks = [
        {
            name: "Home",
        },
        {
            name: "About",
        },
        {
            name: "Project",
        },
        {
            name: "Experience",
        },
        {
            name: "Contact",
        },
    ];

    // when scrolling down hide navbar
    const [prevScrollPos, setPrevScrollPos] = useState(0);
    const [visible, setVisible] = useState(true);

    const handleScroll = () => {
        const currentScrollPos = window.pageYOffset;

        setVisible(prevScrollPos > currentScrollPos);

        setPrevScrollPos(currentScrollPos);
    };

    useEffect(() => {
        window.addEventListener("scroll", handleScroll);

        return () => window.removeEventListener("scroll", handleScroll);
    }, [prevScrollPos, visible, handleScroll]);

    const navbarHide = {
        transform: visible ? "translateY(0)" : "translateY(-100%)",
        transition: "transform 0.4s ease-in-out",
    };

    return (
        <header>
            <nav
                className="fixed top-0 z-50 w-full py-4 pl-6 pr-2 bg-dark duration-300 ease-in-out md:px-12"
                style={navbarHide}
            >
                <div className="container m-auto flexBetween">
                    <a href="/">
                        <img
                            src="/assets/logo.png"
                            alt="Logo"
                            className="w-10 h-10"
                        />
                    </a>

                    <Fade direction="up" cascade damping={0.1} triggerOnce>
                        <ul className="hidden md:flex items-center text-[10pt] text-primary  font-light font-sfmono">
                            {navLinks.map((link, index) => (
                                <li key={index} className="cursor-pointer">
                                    <a
                                        href={`#${link.name.toLowerCase()}`}
                                        className="px-4 py-4"
                                    >
                                        <span className="textHighlight">
                                            0{index + 1}.
                                        </span>
                                        {link.name}
                                    </a>
                                </li>
                            ))}

                            <li className="mx-4 my-8 md:my-0">
                                <a
                                    href="/assets/resume.pdf"
                                    download="Juan Antonio Vivaldy.pdf"
                                >
                                    <button className="px-5 py-3 my-auto btnTertinary">
                                        Resume
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </Fade>
                    <button
                        className="block px-4 py-3 mx-2 rounded md:hidden focus:outline-none bg-dark group focus:bg-none"
                        onClick={() => toggle()}
                    >
                        <div className="w-6 h-1 mb-1 bg-white rounded-full"></div>
                        <div className="w-6 h-1 mb-1 bg-white rounded-full"></div>
                        <div className="w-6 h-1 bg-white rounded-full"></div>
                    </button>

                    <div
                        className={`overlay ${
                            show ? "visible opacity-1" : "invisible opacity-0"
                        }`}
                        onClick={() => toggle()}
                    >
                        <div
                            className={`absolute right-0 z-10 w-screen transition-all duration-300 border-b-2 shadow-2xl bg-dark rounded-br-3xl rounded-bl-3xl ${
                                show ? "top-0" : "-top-[100%]"
                            }`}
                        >
                            <div className="flex justify-center mt-3">
                                <img
                                    src="/assets/logo.png"
                                    alt="Logo"
                                    className="w-20 py-4 pl-8"
                                />
                                <h1 className="font-bold text-[28px] text-primary text-left leading-[23px] my-auto pt-[10px] pl-2 tracking-wide">
                                    <span className="text-highlight">Juan</span>
                                    <br /> Antonio
                                </h1>
                            </div>
                            <ul className="flex flex-col items-center text-[10pt] text-primary font-light font-sfmono pt-6">
                                {navLinks.map((link, index) => (
                                    <li
                                        key={index}
                                        className="px-4 py-4 cursor-pointer"
                                    >
                                        <span className="textHighlight">
                                            0{index + 1}.
                                        </span>
                                        <a href={`#${link.name.toLowerCase()}`}>
                                            {link.name}
                                        </a>
                                    </li>
                                ))}

                                <li className="w-full px-6 my-8 md:my-0">
                                    <a
                                        href="/assets/resume.pdf"
                                        download="Juan Antonio Vivaldy.pdf"
                                    >
                                        <button className="w-full py-3 my-auto btnTertinary">
                                            Resume
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    );
};

export default MainNavbar;
