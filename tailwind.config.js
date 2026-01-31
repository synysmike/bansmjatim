module.exports = {
  purge: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        lato: ["Lato", "sans-serif"],
        poppins: ["Poppins", "sans-serif"],
        "pt-serif": ["PT Serif", "serif"],
        playfair: ["Ubuntu", "sans-serif"],
        elegant: ["Ubuntu", "sans-serif"],
        "elegant-body": ["Ubuntu", "sans-serif"],
        ubuntu: [
          "Ubuntu",
          "-apple-system",
          "BlinkMacSystemFont",
          "Segoe UI",
          "Roboto",
          "sans-serif",
        ],
        "source-sans": ["Source Sans Pro", "sans-serif"],
        inter: ["Ubuntu", "sans-serif"],
      },
      colors: {
        "dark-overlay": "hsla(54, 14%, 15%, 0.562)",
        "admin-primary": "#6366f1",
        "admin-primary-dark": "#4f46e5",
        "admin-primary-light": "#818cf8",
        "admin-secondary": "#8b5cf6",
        "admin-success": "#10b981",
        "admin-danger": "#ef4444",
        "admin-warning": "#f59e0b",
        "admin-info": "#3b82f6",
        "admin-dark": "#1e293b",
        "admin-light": "#f1f5f9",
        "admin-border": "#e2e8f0",
        "admin-text-primary": "#0f172a",
        "admin-text-secondary": "#64748b",
      },
      boxShadow: {
        "admin-sm": "0 1px 2px 0 rgb(0 0 0 / 0.05)",
        admin: "0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)",
        "admin-md":
          "0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)",
        "admin-lg":
          "0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)",
        "admin-xl":
          "0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)",
      },
    },
  },
  plugins: [],
};
