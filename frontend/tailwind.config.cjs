/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./vueform.config.js", // or where `vueform.config.js` is located
    "./node_modules/@vueform/vueform/themes/tailwind/**/*.vue",
    "./node_modules/@vueform/vueform/themes/tailwind/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui"), require("@vueform/vueform/tailwind")],
};
