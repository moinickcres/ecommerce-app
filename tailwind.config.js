// tailwind.config.js
import typography from '@tailwindcss/typography';
import forms from '@tailwindcss/forms';
import aspectRatio from '@tailwindcss/aspect-ratio';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php", // All Blade templates
    "./resources/**/*.js"        // Any JavaScript files
  ],
  safelist: [
    'text-red-500', 'text-blue-500', 'bg-gray-100', 'p-4', // Add commonly used classes here
  ],
  theme: {
    extend: {},
  },
  plugins: [
    typography,
    forms,
    aspectRatio
  ],
}

