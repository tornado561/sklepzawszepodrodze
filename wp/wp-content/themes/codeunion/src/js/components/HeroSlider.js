import KeenSlider from 'keen-slider';

import { sliderController } from '../utils/sliderController.js';

// Dots-only plugin based on Keen Slider docs
function dotsNavigation(slider) {
	let dots;

	function createDiv(className) {
		const div = document.createElement('div');
		className.split(' ').forEach((n) => div.classList.add(n));
		return div;
	}

	function buildDots() {
		// Prefer existing container inside the hero if present; otherwise create `.dots`
		const existing = slider.container.closest('.hero')?.querySelector('.hero__dots');
		dots = existing || createDiv('dots');
		if (!existing) {
			// append next to slider like in docs
			slider.container.parentNode.appendChild(dots);
		} else {
			dots.innerHTML = '';
		}

		slider.track.details.slides.forEach((_e, idx) => {
			const dot = createDiv('dot');
			dot.setAttribute('aria-label', `Go to slide ${idx + 1}`);
			dot.addEventListener('click', () => slider.moveToIdx(idx));
			dots.appendChild(dot);
		});

		updateActive();
	}

	function updateActive() {
		if (!dots) return;
		const rel = slider.track.details.rel;
		Array.from(dots.children).forEach((dot, idx) => {
			dot.classList.toggle('dot--active', idx === rel); // matches docs class
			dot.classList.toggle('is-active', idx === rel); // optional if project styles use this
		});
	}

	slider.on('created', buildDots);
	slider.on('optionsChanged', buildDots);
	slider.on('slideChanged', updateActive);
	slider.on('destroyed', () => {
		if (dots && !dots.classList.contains('hero__dots')) dots.remove();
	});
}

export default class HeroSliderSection {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: '.hero',
			slider: '.hero__slider',
			navLeft: '.hero__prev',
			navRight: '.hero__next',
		};

		this.init = document.querySelectorAll(this.settings.init);
		if (this.init.length === 0) return false;

		this.setEvents();
	}

	setEvents() {
		this.init.forEach((el) => {
			const elSlider = el.querySelector(this.settings.slider);
			if (!elSlider) return;

			const navLeft = el.querySelector(this.settings.navLeft);
			const navRight = el.querySelector(this.settings.navRight);
			const slides = elSlider.querySelectorAll('.keen-slider__slide');

			const sliderOptions = {
				loop: true,
				slides: { perView: 1, spacing: 30 },
				autoplay: 3000,
				breakpoints: {
					'(max-width: 1024px)': { slides: { perView: 1, spacing: 30 } },
					'(max-width: 680px)': { slides: { perView: 1, spacing: 20 } },
				},
			};

			const slider = new KeenSlider(elSlider, sliderOptions, [dotsNavigation]);

			const updateSlider = () => sliderController(slider, [elSlider], sliderOptions, slides);
			window.addEventListener('resize', updateSlider);
			updateSlider();

			if (navLeft) navLeft.addEventListener('click', () => slider.prev());
			if (navRight) navRight.addEventListener('click', () => slider.next());
		});
	}
}
