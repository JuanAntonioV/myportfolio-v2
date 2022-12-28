const Button = ({children, classname}) => {
    return (
        <button className={`btnTertinary ${classname ? classname : ''}`}>
            {children}
        </button>
    );
};

export default Button;
