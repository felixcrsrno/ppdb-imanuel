/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'sans-serif'],
      },
      colors: {
        // Brand colors
        primary: {
          DEFAULT: '#0B3B64', // navy / dark blue
          500: '#0B3B64',
          600: '#083057'
        },
        royal: '#1E5FFF', // school/royal blue

        // Backgrounds
        'bg-light': '#F5F9FF', // very light blue-gray

        // Text
        'text-navy': '#08263A',

        // Semantic
        success: '#16A34A',
        warning: '#F59E0B',
        danger: '#EF4444',
        info: '#3B82F6',
        neutral: {
          DEFAULT: '#6B7280',
          200: '#E6E9EE',
        },
      },
      borderRadius: {
        'md': '0.5rem',
        'lg': '0.75rem',
        'xl': '1rem',
        'card': '0.75rem',
        'modal': '1rem'
      },
      boxShadow: {
        subtle: '0 1px 2px rgba(2,6,23,0.06), 0 1px 0 rgba(2,6,23,0.02)',
        card: '0 4px 12px rgba(11,59,100,0.06)'
      },
      spacing: {
        '9': '2.25rem'
      },
      fontSize: {
        '2xs': ['0.65rem', { lineHeight: '1rem' }]
      }
    },
  },
  plugins: [],
}
