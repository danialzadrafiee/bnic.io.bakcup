module.exports = {
    theme: {
        extend: {
            colors: {
                primary: "#0084ff",
                secondary: "#3fdd78",
                "accent-1": "#dda73f",
                "accent-2": "#8c6583",
                "accent-3": "#3e90f0",
                "accent-4": "#d84c10",
                "accent-5": "#8e55ea",
                "accent-6": "#239550",
                "neutral-0": "#fafafa",
                "neutral-1": "#fefefe",
                "neutral-2": "#fefefe",
                "neutral-3": "#f5f5f5",
                "neutral-4": "#e8ecef",
                "neutral-5": "#6c7275",
                "base-content": "#1c1b20",
            },
        },
    },
    content: ["./resources/**/*.blade.php", "./resources/**/*.js", "./resources/**/*.vue", "./node_modules/flowbite/**/*.js"],
    plugins: [
        require("@tailwindcss/container-queries"),
        require("@tailwindcss/forms")({
            strategy: "class",
        }),
        require("daisyui"),
    ],
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#0084ff",
                    neutral:"#1c1b20",
                    secondary: "#3fdd78",
                    accent: "#86e5c2",
                    "base-100": "#fefefe",
                    "base-200": "#fcfcfc",
                    "base-300": "#6c7275",
                    "base-content": "#141718",
                    info: "#3e90f0",
                    success: "#239550",
                    warning: "#dda73f",
                    error: "#d84c10",
                    
                },
            },
        ],
    },
}
