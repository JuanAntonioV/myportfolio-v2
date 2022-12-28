import {Fade} from "react-awesome-reveal";
import React from "react";

const EmailSticky = () => {
    return (
        <Fade right>
            <div className={'hidden lg:block fixed right-10 bottom-0'}>
                <div className='relative h-[360px] w-10'>
                    <a
                        href='mailto:juananthonio23@gmail.com'
                        className='block rotate-90 font-sfmono text-secondary text-[14px] tracking-wider translate-y-0 hover:-translate-y-1 hover:text-highlight duration-300 ease-in-out'
                    >
                        juananthonio23@gmail.com
                    </a>
                    <span className='absolute bottom-0 left-1/2 -translate-x-1/2 border-l border-secondary h-28'></span>
                </div>
            </div>
        </Fade>
    );
};

export default EmailSticky;
