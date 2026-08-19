import {fileURLToPath, URL} from 'node:url'
import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import FullReload from 'vite-plugin-full-reload';

export default defineConfig({
	publicDir: '',
	build: {
		manifest: true,
		outDir: 'public/build',
		rollupOptions: {
			input: [
				'src/scss/core.scss',
				'src/js/Core.js',
			],
		},
	},
	plugins: [
		vue({
			template: {
				transformAssetUrls: {
					includeAbsolute: false
				}
			}
		}),
		FullReload(['**/*.php']),
	],
	server: {
		host: "0.0.0.0",
		port: 5173,
		strictPort: true,
		watch: {
			usePolling: true,
		},
		hmr: {
			overlay: false,
		},
	},
	resolve: {
		alias: {
			'@': fileURLToPath(new URL('./src', import.meta.url))
		}
	},
})
