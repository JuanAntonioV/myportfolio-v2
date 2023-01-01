import { useEffect, useRef, useState } from "react";

const TabMenu = ({ tabs, active, onActive, vertical, className }) => {
    const btnRef = useRef(null);
    const [tabWidth, setTabWidth] = useState(0);
    const [tabHeight, setTabHeight] = useState(0);

    const handleTabClick = (index) => {
        const width = btnRef.current.clientWidth;
        const height = btnRef.current.clientHeight;
        !vertical ? setTabWidth(width) : setTabHeight(height);
        onActive(index);
    };

    const activeAnimationStyle = {
        width: `${tabWidth}px`,
        transform: `translateX(${active * tabWidth}px)`,
    };

    const activeAnimationStyleVertical = {
        height: `${tabHeight}px`,
        transform: `translateY(${active * tabHeight}px)`,
    };

    useEffect(() => {
        const width = btnRef.current.clientWidth;
        const height = btnRef.current.clientHeight;
        !vertical ? setTabWidth(width) : setTabHeight(height);
    }, [btnRef, vertical]);

    return (
        <div
            className={
                !vertical
                    ? "flex items-center w-fit relative"
                    : "flex items-center flex-col relative w-full"
            }
        >
            {tabs.map((tab, index) => (
                <button
                    key={tab.id}
                    className={`w-full h-14 text-start pl-8 hover:bg-hoverTertinary hover:text-tertinary duration-300 ${
                        index === active
                            ? "bg-hoverTertinary text-tertinary"
                            : ""
                    } ${className ? className : ""}`}
                    onClick={() => handleTabClick(index)}
                    ref={btnRef}
                >
                    {tab.title}
                </button>
            ))}
            <div
                className={
                    !vertical
                        ? "bg-tertinary duration-300 h-[2px] absolute bottom-0 left-0 rounded-full"
                        : "bg-tertinary duration-300 w-[2px] absolute rounded-full" +
                          " top-0 left-0"
                }
                style={
                    !vertical
                        ? activeAnimationStyle
                        : activeAnimationStyleVertical
                }
            ></div>
        </div>
    );
};

export default TabMenu;
