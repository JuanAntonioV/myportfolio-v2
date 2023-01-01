import React from "react";
import { Fade } from "react-awesome-reveal";
import GitHubIcon from "@/assets/icons/GitHubIcon";
import LinkedinIcon from "@/assets/icons/LinkedinIcon";
import InstagramIcon from "@/assets/icons/InstagramIcon";
import WhatsAppIcon from "@/assets/icons/WhatsAppIcon";

const SocialMediaSticky = () => {
    return (
        <Fade
            direction="left"
            className="fixed bottom-0 hidden lg:block left-10"
        >
            <div className="relative h-[350px]">
                <ul className={"flex items-center flex-col gap-7"}>
                    <li className="list-none">
                        <a
                            href="https://github.com/JuanAntonioV"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <GitHubIcon
                                width="24"
                                className="duration-300 ease-in-out translate-y-0 fill-secondary hover:-translate-y-1 hover:fill-primary"
                            />
                        </a>
                    </li>
                    <li className="list-none">
                        <a
                            href="https://www.linkedin.com/in/juan-antonio-vivaldy-saragih-b54b93237"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <LinkedinIcon
                                width="22"
                                className="duration-300 ease-in-out translate-y-0 fill-secondary hover:-translate-y-1 hover:fill-primary"
                            />
                        </a>
                    </li>
                    <li className="list-none">
                        <a
                            href="https://www.instagram.com/ja_atiov"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <InstagramIcon
                                width="20"
                                className="duration-300 ease-in-out translate-y-0 fill-secondary hover:-translate-y-1 hover:fill-primary"
                            />
                        </a>
                    </li>
                    <li className="list-none">
                        <a
                            href="https://wa.me/6282142213434"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <WhatsAppIcon
                                width="21"
                                className="duration-300 ease-in-out translate-y-0 fill-secondary hover:-translate-y-1 hover:fill-primary"
                            />
                        </a>
                    </li>
                </ul>
                <span className="absolute left-1/2 -translate-x-1/2 bottom-0 bg-secondary w-[1px] h-36"></span>
            </div>
        </Fade>
    );
};

export default SocialMediaSticky;
