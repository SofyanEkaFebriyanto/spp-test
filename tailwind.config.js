/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1e40af',
      },
      borderRadius: {
        lg: '8px',
      },
    },
  },
  plugins: [],
};
