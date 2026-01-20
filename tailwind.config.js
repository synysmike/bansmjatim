module.exports = {
  purge: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        'lato': ['Lato', 'sans-serif'],
        'poppins': ['Poppins', 'sans-serif'],
        'pt-serif': ['PT Serif', 'serif'],
      },
      colors: {
        'dark-overlay': 'hsla(54, 14%, 15%, 0.562)',
      },
    },
  },
  plugins: [],
}
