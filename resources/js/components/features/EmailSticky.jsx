import { Fade } from "react-awesome-reveal";
import React from "react";

const EmailSticky = () => {
    return (
        <Fade
            direction="right"
            className="fixed bottom-0 hidden lg:block right-10"
        >
            <div className="relative h-[360px] w-10">
                <a
                    href="mailto:juananthonio23@gmail.com"
                    className="block rotate-90 font-sfmono text-secondary text-[14px] tracking-wider translate-y-0 hover:-translate-y-1 hover:text-highlight duration-300 ease-in-out"
                >
                    juananthonio23@gmail.com
                </a>
                <span className="absolute bottom-0 -translate-x-1/2 border-l left-1/2 border-secondary h-28"></span>
            </div>
        </Fade>
    );
};

export default EmailSticky;
