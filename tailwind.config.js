/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./app/View/Components/**/*.php",
    ],
    darkMode: "class",
    theme: {
        extend: {
            colors: {
                // Warna sesuai dokumen konsep Healthcare.id
                primary: {
                    DEFAULT: "#2563EB", // Biru Medis
                    50: "#EFF6FF",
                    100: "#DBEAFE",
                    200: "#BFDBFE",
                    300: "#93C5FD",
                    400: "#60A5FA",
                    500: "#3B82F6",
                    600: "#2563EB",
                    700: "#1D4ED8",
                    800: "#1E40AF",
                    900: "#1E3A8A",
                },
                secondary: {
                    DEFAULT: "#10B981", // Hijau Sehat
                    50: "#ECFDF5",
                    100: "#D1FAE5",
                    500: "#10B981",
                    600: "#059669",
                    700: "#047857",
                },
                softbg: "#F8FAFC",
                inkdark: "#0F172A", // Text hitam gelap
                breaking: {
                    DEFAULT: "#EF4444", // Merah breaking news
                    50: "#FEF2F2",
                    600: "#DC2626",
                    700: "#B91C1C",
                },
            },
            fontFamily: {
                sans: ["Inter", "Manrope", "ui-sans-serif", "system-ui", "sans-serif"],
            },
            borderRadius: {
                card: "0.875rem",
            },
            boxShadow: {
                card: "0 1px 3px 0 rgba(15, 23, 42, 0.06), 0 1px 2px -1px rgba(15, 23, 42, 0.06)",
                "card-hover": "0 8px 20px -4px rgba(15, 23, 42, 0.12)",
            },
            animation: {
                marquee: "marquee 30s linear infinite",
            },
            keyframes: {
                marquee: {
                    "0%": { transform: "translateX(100%)" },
                    "100%": { transform: "translateX(-100%)" },
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
