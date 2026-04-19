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
        // Colores personalizados de EcoGuide
        'eco-green': '#9ba781',
        'eco-green-glass': 'rgba(155, 167, 129, 0.85)', 
        'eco-beige': '#f4f1ea',
        'eco-sand': '#dccfb4',
      },
      fontFamily: {
        // Fuente elegante para títulos (Canva style)
        'serif': ['Playfair Display', 'serif'],
      }
    },
  },
  plugins: [],
}