const TitleSection = ({ before, title, line }) => {
    return (
        <div className="flexCenter">
            <span className="text-base textHighlight">
                {before ? before : "01."}
            </span>
            <h4 className="ml-3 mr-8 textTitle text-primary">
                {title ? title : "Title"}
            </h4>
            {line && <span className="w-72 h-[1px] bg-secondary"></span>}
        </div>
    );
};

export default TitleSection;
