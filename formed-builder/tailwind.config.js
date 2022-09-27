module.exports = {
  purge: [
      './index.html',
      './src/**/*.{js,jsx}',
      '../resources/**/*.blade.php',
      '../resources/**/*.js',
      '../resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      zIndex: {
        '-1': '-1',
      },
      margin: {
        '-15': '-4.5rem'
      },
      cursor: {
        grab: 'grab'
      },
      width: {
        base: '30rem'
      },
      maxWidth: {
        base: '30rem'
      },
      minWidth: {
        '60': '15rem'
      }
    },
    borderColor: theme => ({
      ...theme('colors'),
       DEFAULT: '#cbd5e1',
     })
  },
  variants: {
    extend: {
      display: ['group-hover', 'group-focus'],
      backgroundColor: ['group-focus']
    },
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
}
