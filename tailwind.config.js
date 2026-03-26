/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'eco-green': '#9ba781',
        // Este es el secreto: el mismo verde pero con 85% de opacidad
        'eco-green-glass': 'rgba(155, 167, 129, 0.85)', 
        'eco-beige': '#f4f1ea',
        'eco-sand': '#dccfb4',
      },
      fontFamily: {
        'serif': ['Playfair Display', 'serif'],
      }
    },
  },
  plugins: [],
}