import js from "@eslint/js";
import vue from "eslint-plugin-vue";
import vueParser from "vue-eslint-parser";
import unusedImports from "eslint-plugin-unused-imports";
import prettier from "eslint-plugin-prettier";
import prettierConfig from "eslint-config-prettier";
import simpleImportSort from "eslint-plugin-simple-import-sort";

export default [
	js.configs.recommended,
	{
		plugins: {
			"unused-imports": unusedImports,
			"prettier": prettier,
			"simple-import-sort": simpleImportSort,
			"vue": vue
		},
		languageOptions: {
			ecmaVersion: "latest",
			sourceType: "module",
			parser: vueParser,
			parserOptions: {
				parser: "@babel/eslint-parser",
				requireConfigFile: false,
				sourceType: "module",
				ecmaFeatures: {
					jsx: true
				}
			},
			globals: {
				window: "readonly",
				document: "readonly",
				console: "readonly",
				setTimeout: "readonly",
				setInterval: "readonly",
				clearTimeout: "readonly",
				clearInterval: "readonly",
				localStorage: "readonly",
				sessionStorage: "readonly",
				fetch: "readonly",
				alert: "readonly",
				prompt: "readonly",
				confirm: "readonly",
				navigator: "readonly",
				history: "readonly",
				location: "readonly",
				performance: "readonly",
				process: "readonly",
				require: "readonly",
				module: "readonly",
				exports: "readonly",
				global: "readonly",
				__dirname: "readonly",
				__filename: "readonly",
				URL: "readonly",
				dataLayer: "readonly",
			},
		},
		rules: {
			"vue/html-indent": ["error", "tab"],
			"vue/html-self-closing": [
				"error",
				{
					html: {
						void: "always",
						normal: "never",
						component: "always"
					},
					svg: "always",
					math: "always"
				}
			],
			"vue/no-unused-components": "warn",
			"vue/no-multiple-template-root": "off",
			"vue/multi-word-component-names": "off",

			"no-console": ["warn", { allow: ["warn", "error"] }],
			"no-unused-vars": "warn",
			"unused-imports/no-unused-imports": "warn",
			"prettier/prettier": "warn",
			"simple-import-sort/imports": "warn",
			"simple-import-sort/exports": "warn",
		},
	},
	prettierConfig,
];
