import globals from "globals";
import tsParser from "@typescript-eslint/parser";

/** Turns off the eslint config error */
const off = "off", 
/** Warning for eslint config */
warn = "warn",
/** Error for eslint config */
error = "error",
/** Timing identifier for eslint config */
always = "always";

/**
 * @type {import('eslint').Linter.Config}
 */
export default [
  {
    files: ["**/*.{ts,tsx}"],  // Match all TS and JS files
    ignores: ["node_modules/"],  // Optionally ignore node_modules
    languageOptions: {
      parser: tsParser,
      parserOptions: {
        project: "./tsconfig.json",  // Use tsconfig.json for TypeScript setup
      },
      globals: {
        $: 'readonly',
        jQuery: 'readonly',
        ...globals.browser,  // Merge browser globals
      },
    },
    rules: {
      "class-methods-use-this": [error, { exceptMethods: [] }],
      "func-style": [warn, "declaration", { allowArrowFunctions: true }],
      "prefer-arrow-callback": [warn, { allowNamedFunctions: true }],
      "semi": [warn, always],
      "camelcase": warn,
      "eqeqeq": error,
      "no-useless-catch": warn,
      "no-useless-escape": warn,
      "no-useless-constructor": warn,
      "no-var": error,
      "prefer-const": warn,
      "prefer-exponentiation-operator": warn,
      "require-await": error,
      "require-yield": error,
      "getter-return": error,
      "no-compare-neg-zero": error,
      "no-constant-condition": warn,
      "no-dupe-else-if": error,
      "no-self-assign": error,
      "no-setter-return": error,
      "no-unreachable": error,
      "use-isnan": warn,
    },
  },
  {
    files: ["**/*.{js,mjs,cjs}"],  // Apply a separate config for JS files
    ignores: ["node_modules/"],
    languageOptions: {
      globals: {
        $: 'readonly',
        jQuery: 'readonly',
        ...globals.browser,
      },
    },
    rules: {
      "class-methods-use-this": [error, { exceptMethods: [] }],
      "func-style": [warn, "declaration", { allowArrowFunctions: true }],
      "prefer-arrow-callback": [warn, { allowNamedFunctions: true }],
      "semi": [warn, always],
      "camelcase": warn,
      "eqeqeq": error,
      "no-useless-catch": warn,
      "no-useless-escape": warn,
      "no-useless-constructor": warn,
      "no-var": error,
      "prefer-const": warn,
      "prefer-exponentiation-operator": warn,
      "require-await": error,
      "require-yield": error,
      "getter-return": error,
      "no-compare-neg-zero": error,
      "no-constant-condition": warn,
      "no-dupe-else-if": error,
      "no-self-assign": error,
      "no-setter-return": error,
      "no-unreachable": error,
      "use-isnan": warn,
    },
  },
];
