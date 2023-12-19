module.exports = {
    root: true,
    env: {
      node: true,
      jest: true
    },
    extends: [
      'plugin:vue/essential',
      '@vue/airbnb'
    ],
    rules: {
      'no-console': 'error',
      'no-debugger': 'error',
      'space-in-parens': ['off'],
      quotes: ['error', 'single'],
      'no-undef': ['off'],
      'computed-property-spacing': ['off'],
      'linebreak-style': ['off'],
      'brace-style': [2, 'stroustrup', { allowSingleLine: false }],
      'comma-dangle': ['error', 'never'],
      'no-param-reassign': ['error', { props: false }],
      semi: ['error', 'never'],
      camelcase: ['error', { properties: 'always' }],
      'function-paren-newline': ['off'],
      'implicit-arrow-linebreak': ['off'],
      'prefer-arrow-callback': ['off'],
      'arrow-body-style': ['off'],
      'no-return-assign': ['off'],
      'array-callback-return': ['off'],
      'prefer-destructuring': ['off'],
      'no-tabs': ['off'],
      'no-mixed-spaces-and-tabs': ['off'],
      'class-methods-use-this': ['off'],
      'no-useless-escape': ['off'],
      radix: ['error', 'as-needed'],
      'import/no-cycle': ['off']
    },
    parserOptions: {
      parser: 'babel-eslint'
    }
  }