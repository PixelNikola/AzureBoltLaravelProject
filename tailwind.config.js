/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/profiles/profile.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",

  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('tailwind-scrollbar')({ nocompatible: true }),
  ],
}

