const TitleSection = ({ before, title, line }) => {
    return (
        <div className="my-8 flexStart">
            <span className="text-lg textHighlight">
                {before ? before : "01."}
            </span>
            <h4 className="ml-3 mr-8 textTitle text-primary">
                {title ? title : "Title"}
            </h4>
            {line && <span className="w-80 h-[1px] bg-secondary"></span>}
        </div>
    );
};

export default TitleSection;
