/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          primary: '#27AE60',
          secondary: '#F4D03F',
          accent: '#3498DB',
          danger: '#E74C3C',
          light: '#ECF0F1',
        },
      },
    },
    plugins: [],
  }