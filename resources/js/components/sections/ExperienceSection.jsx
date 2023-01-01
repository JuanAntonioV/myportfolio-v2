import TitleSection from "../title/SectionTitle";
import TabMenu from "./../tabs/TabMenu";
import { useState } from "react";

const ExperienceSection = () => {
    const [active, setActive] = useState(0);

    const tabs = [
        { id: 1, title: "Brighton" },
        { id: 2, title: "Tokohardware" },
    ];

    return (
        <section id="experience" className="mx-36 my-36">
            <TitleSection title={"Where I’ve Worked"} before={"02."} line />

            <div className="grid grid-cols-7 mt-16">
                <div className="col-span-2">
                    <TabMenu
                        tabs={tabs}
                        vertical
                        active={active}
                        onActive={setActive}
                        className="text-[14px] text-secondary font-sfmono"
                    />
                </div>

                <div className="col-span-5">
                    {active === 0 && (
                        <div className="block" key={jobs.id}>
                            <h3 className="text-primary pl-4 font-calibre font-bold text-[20pt]">
                                <span className="text-highlight"> @ </span>
                                <a
                                    className="relative text-highlight"
                                    id="elc"
                                    href={jobs.link}
                                >
                                    {jobs.name}
                                </a>
                            </h3>

                            <p className="pt-4 pl-4 text-sm lg:pt-0 font-sfmono text-secondary">
                                {jobs.timeStatus}
                            </p>
                            <ul className="relative pt-8 pl-4 text-lg font-calibre text-secondary">
                                {jobs.jobsDesk.map((data) => {
                                    return (
                                        <li
                                            key={data.id}
                                            className='before:content-["▹"] before:left-4 before:absolute pl-6 pb-2'
                                        >
                                            {data.decs}
                                        </li>
                                    );
                                })}
                            </ul>
                        </div>
                    )}
                </div>
            </div>
        </section>
    );
};

export default ExperienceSection;
