// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        black: '#060606', // eigene black-Farbe
      },
      fontFamily: {
        "hanken-grotesk": ["Hanken Grotesk","sans-serif"]
      }
    },
  },
  plugins: [],
}
