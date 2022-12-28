import {configureStore} from "@reduxjs/toolkit";

// Modules
import userReducer from "./modules/userReducer";

const store = configureStore({
    reducer: {
        user: userReducer,
    }
});

export default store;
