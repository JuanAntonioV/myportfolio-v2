import {useCallback, useState} from "react";

const UseToggle = () => {
    const [state, setState] = useState(false);
    const toggle = useCallback(() => setState(state => !state), []);
    return [state, toggle];
};

export default UseToggle;
