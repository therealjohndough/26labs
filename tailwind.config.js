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
        // Case Study Labs brand palette
        black: '#0a0a0a',
        white: '#f5f2ee',
        cream: '#ede9e3',
        accent: '#c8f04a',      // Electric lime
        primary: '#c8f04a',     // Alias for accent — used in @apply directives
        mid: '#1a1a1a',
        dark: '#0a0a0a',
        light: '#f5f2ee',
        border: 'rgba(245,242,238,0.12)',
        'text-primary': '#f5f2ee',
        'text-secondary': 'rgba(245,242,238,0.55)',
        'text-muted': 'rgba(245,242,238,0.35)',
        'text-subtle': 'rgba(245,242,238,0.2)',
      },
      fontFamily: {
        sans: ['Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif'],
        serif: ['Space Mono', 'monospace']
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
