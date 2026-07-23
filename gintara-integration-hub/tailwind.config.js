/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        surface: '#F2F4FA',
        card: '#FFFFFF',
        primary: {
          DEFAULT: '#3B6DF4',
          50: '#EEF2FE',
          100: '#DCE6FD',
          200: '#B9CCFB',
          400: '#5C86F5',
          500: '#3B6DF4',
          600: '#2952DE',
          700: '#1F3FB0',
          glow: 'rgba(59, 109, 244, 0.35)',
        },
        success: {
          DEFAULT: '#16C264',
          bg: '#E4FAEC',
          glow: 'rgba(22, 194, 100, 0.35)',
        },
        warning: {
          DEFAULT: '#F2970B',
          bg: '#FEF0DD',
          glow: 'rgba(242, 151, 11, 0.35)',
        },
        danger: {
          DEFAULT: '#EF4444',
          bg: '#FDECEC',
          glow: 'rgba(239, 68, 68, 0.35)',
        },
        ink: {
          DEFAULT: '#181D2A',
          soft: '#6B7280',
        },
      },

      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'system-ui'],
      },

      borderRadius: {
        card: '1.25rem',
      },

      boxShadow: {
        card: '0 2px 10px rgba(24, 29, 42, 0.06)',
        'card-lg': '0 12px 30px -8px rgba(24, 29, 42, 0.18)',
        glow: '0 0 0 4px var(--tw-shadow-color)',
      },

      keyframes: {
        fadeInUp: {
          '0%': {
            opacity: '0',
            transform: 'translateY(10px)',
          },
          '100%': {
            opacity: '1',
            transform: 'translateY(0)',
          },
        },

        scaleIn: {
          '0%': {
            opacity: '0',
            transform: 'scale(.95)',
          },
          '100%': {
            opacity: '1',
            transform: 'scale(1)',
          },
        },

        shimmer: {
          '0%': {
            backgroundPosition: '-400px 0',
          },
          '100%': {
            backgroundPosition: '400px 0',
          },
        },

        ripple: {
          '0%': {
            transform: 'scale(0)',
            opacity: '0.45',
          },
          '100%': {
            transform: 'scale(2.5)',
            opacity: '0',
          },
        },

        countPop: {
          '0%': {
            transform: 'scale(1)',
          },
          '30%': {
            transform: 'scale(1.08)',
          },
          '100%': {
            transform: 'scale(1)',
          },
        },
      },

      animation: {
        'fade-in-up': 'fadeInUp .45s cubic-bezier(.16,1,.3,1) both',
        'scale-in': 'scaleIn .25s cubic-bezier(.16,1,.3,1) both',
        shimmer: 'shimmer 1.4s ease-in-out infinite',
        ripple: 'ripple .6s ease-out forwards',
        'count-pop': 'countPop .35s ease-out',
      },
    },
  },
  plugins: [],
};