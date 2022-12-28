import React from "react";
import {Fade} from "react-awesome-reveal";
import GitHubIcon from "@/assets/icons/GitHubIcon";
import LinkedinIcon from "@/assets/icons/LinkedinIcon";
import InstagramIcon from "@/assets/icons/InstagramIcon";
import WhatsAppIcon from "@/assets/icons/WhatsAppIcon";

const SocialMediaSticky = () => {
    return (
        <Fade left>
            <div className={'hidden lg:block fixed bottom-0 left-10'}>
                <div className='relative h-[370px]'>
                    <ul className={'flex items-center flex-col gap-8'}>
                        <li className='list-none'>
                            <a href='https://github.com/JuanAntonioV' target="_blank" rel="noopener noreferrer">
                                <GitHubIcon/>
                            </a>
                        </li>
                        <li className='list-none'>
                            <a href='https://www.linkedin.com/in/juan-antonio-vivaldy-saragih-b54b93237' target="_blank" rel="noopener noreferrer">
                                <LinkedinIcon/>
                            </a>
                        </li>
                        <li className='list-none'>
                            <a href='https://www.instagram.com/ja_atiov' target="_blank" rel="noopener noreferrer">
                                <InstagramIcon/>
                            </a>
                        </li>
                        <li className='list-none'>
                            <a href='https://wa.me/6282181240375' target="_blank" rel="noopener noreferrer">
                                <WhatsAppIcon/>
                            </a>
                        </li>
                    </ul>
                    <span className='absolute left-1/2 -translate-x-1/2 bottom-0 bg-secondary w-[1px] h-36'></span>
                </div>
            </div>
        </Fade>
    );
};

export default SocialMediaSticky;
