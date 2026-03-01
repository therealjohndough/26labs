/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/**/*.php",
    "./public/**/*.html",
    "./views/**/*.php"
  ],
  theme: {
    extend: {
      colors: {
        // Brand palette
        black: '#1a1a1a',
        white: '#f9f9f9',
        accent: '#d4a574',      // Gold
        primary: '#2d5016',      // Deep Green
        dark: '#1a1a1a',
        light: '#f9f9f9',
        border: '#e5e5e5',
        'text-secondary': 'rgba(102, 102, 102, 0.8)',
        'text-muted': 'rgba(102, 102, 102, 0.6)',
        'text-subtle': 'rgba(102, 102, 102, 0.4)',
      },
      fontFamily: {
        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'sans-serif'],
        serif: ['Georgia', 'Times New Roman', 'serif']
      },
      fontSize: {
        eyebrow: ['11px', { letterSpacing: '0.22em' }],
        hero: ['clamp(48px, 8vw, 64px)', { lineHeight: '1.1', letterSpacing: '-0.02em' }],
        display: ['clamp(32px, 4.5vw, 48px)', { lineHeight: '1.2' }],
        lg: '18px',
        base: '16px',
        sm: '14px',
        xs: '12px'
      },
      spacing: {
        xs: '4px',
        sm: '8px',
        md: '16px',
        lg: '24px',
        xl: '32px',
        '2xl': '48px',
        '3xl': '64px'
      },
      transitionTimingFunction: {
        'out': 'cubic-bezier(0.4, 0, 0.2, 1)',
      },
      transitionDuration: {
        'fast': '150ms',
        'base': '250ms',
        'slow': '350ms'
      }
    }
  },
  plugins: []
}
