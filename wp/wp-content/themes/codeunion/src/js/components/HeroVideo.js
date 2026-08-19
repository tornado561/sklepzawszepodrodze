export default class HeroVideo {
	constructor() {
		this.videos = document.querySelectorAll('[data-hero-video]');

		if (this.videos.length === 0) {
			return;
		}

		this.init();
	}

	init() {
		const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		const saveData = navigator.connection?.saveData === true;

		this.applyPortraitSources();

		// Respect user and network preferences — the poster stays visible instead.
		if (prefersReducedMotion || saveData) {
			return;
		}

		// Defer playback until the page has fully loaded so the video
		// does not compete with critical assets for bandwidth.
		if (document.readyState === 'complete') {
			this.play();
		} else {
			window.addEventListener('load', () => this.play(), { once: true });
		}
	}

	applyPortraitSources() {
		// The landscape master has burned-in texts that portrait screens would
		// crop away, so portrait devices get a dedicated letterboxed cut.
		if (!window.matchMedia('(orientation: portrait)').matches) {
			return;
		}

		this.videos.forEach((video) => {
			const portraitPoster = video.dataset.posterPortrait;

			if (portraitPoster) {
				video.poster = portraitPoster;
			}

			let swapped = false;

			video.querySelectorAll('source').forEach((source) => {
				const portraitSrc = source.dataset.srcPortrait;

				if (portraitSrc) {
					source.src = portraitSrc;
					swapped = true;
				}
			});

			if (swapped) {
				video.load();
			}
		});
	}

	play() {
		this.videos.forEach((video) => {
			video.muted = true;
			const playPromise = video.play();

			if (playPromise !== undefined) {
				// Autoplay can still be blocked (e.g. iOS Low Power Mode) — poster remains.
				playPromise.catch(() => {});
			}
		});
	}
}
