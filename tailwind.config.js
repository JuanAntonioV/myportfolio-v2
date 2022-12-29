/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.{js,jsx,ts,tsx}"],
    theme: {
        extend: {
            colors: {
                primary: "#ccd6f6",
                secondary: "#8892b0",
                tertinary: "#64ffda",
                hoverTertinary: "rgba(100,255,218,0.1)",
                primaryLight: "#d0d9f3",
                dark: "#0a192f",
                active: "#8892b021",
                card: "#112240",
            },
            fontFamily: {
                calibre: ["Calibre", "sans-serif"],
                sfmono: ["SFMono", "sans-serif"],
            },
            fontSize: {
                base: "1rem",
            },
        },
    },
    plugins: [],
};
