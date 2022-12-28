import React from "react";
import {createRoot} from "react-dom/client";
import {BrowserRouter} from "react-router-dom";

const container = document.getElementById("app");
const root = createRoot(container);

// Pages
import App from "@/js/pages/App";

// Store
import {Provider} from "react-redux";
import store from "@/js/store";

if (container) {
    root.render(
        <React.StrictMode>
            <Provider store={store}>
                <BrowserRouter>
                    <App/>
                </BrowserRouter>
            </Provider>
        </React.StrictMode>
    )
}
