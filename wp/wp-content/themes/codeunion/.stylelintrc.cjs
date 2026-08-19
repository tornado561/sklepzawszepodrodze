module.exports = {
	extends: [
		"stylelint-config-standard",
		"stylelint-config-recommended-scss"
	],
	plugins: ["stylelint-order"],
	rules: {
		// "string-quotes": "single",
		"block-no-empty": null,
		"color-hex-length": "long",
		"max-nesting-depth": 6,
		"selector-max-id": 0,
		"selector-class-pattern": null,
		"selector-pseudo-element-colon-notation": "single",
		"media-feature-range-notation": "prefix",
		"selector-no-vendor-prefix": null,
		"keyframes-name-pattern": null,
		"alpha-value-notation": "number",
		"declaration-block-no-redundant-longhand-properties": null,
		"color-function-notation": "legacy",
		"order/properties-alphabetical-order": true,
		"declaration-property-value-no-unknown": [
			true,
			{
				"ignoreProperties": {
					"/.+/": "/\\$/"
				}
			}
		]
	},
	ignoreFiles: ["src/scss/vendors/**/*.scss"]
};
