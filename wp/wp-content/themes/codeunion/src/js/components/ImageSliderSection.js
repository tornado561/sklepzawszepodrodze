import KeenSlider from 'keen-slider';

import { sliderController } from '../utils/sliderController.js';

export default class ImageSliderSection {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: 'data-image-slider-section',
			slider: 'data-slider',
			visibleSlides: 'data-items',
			navBox: 'data-nav',
			navLeft: 'data-nav-prev',
			navRight: 'data-nav-next',
			activeAttr: 'data-active',
		};

		this.init = document.querySelectorAll(`[${this.settings.init}]`);
		if (this.init.length === 0) return false;

		this.setEvents();
	}

	setEvents() {
		this.init.forEach((el) => {
			const elSlider = el.querySelector(`[${this.settings.slider}]`);
			if (!elSlider) return;

			const navBox = el.querySelector(`[${this.settings.navBox}]`);
			const navLeft = el.querySelector(`[${this.settings.navLeft}]`);
			const navRight = el.querySelector(`[${this.settings.navRight}]`);
			const slides = elSlider.querySelectorAll('.keen-slider__slide');
			const elementsArr = [elSlider, navBox].filter(Boolean);

			const visibleSlides = Number(elSlider.getAttribute(this.settings.visibleSlides)) || 3;

			const sliderConfigs = {
				1: {
					slides: { perView: 1, spacing: 30 },
					breakpoints: {
						'(max-width: 1024px)': { slides: { perView: 1, spacing: 30 } },
						'(max-width: 680px)': { slides: { perView: 1, spacing: 30 } },
					},
				},
				2: {
					slides: { perView: 2, spacing: 30 },
					breakpoints: {
						'(max-width: 1024px)': { slides: { perView: 1, spacing: 30 } },
						'(max-width: 680px)': { slides: { perView: 1, spacing: 30 } },
					},
				},
				3: {
					slides: { perView: 3, spacing: 30 },
					breakpoints: {
						'(max-width: 1024px)': { slides: { perView: 2, spacing: 30 } },
						'(max-width: 680px)': { slides: { perView: 1, spacing: 30 } },
					},
				},
				4: {
					slides: { perView: 4, spacing: 30 },
					breakpoints: {
						'(max-width: 1024px)': { slides: { perView: 2, spacing: 30 } },
						'(max-width: 680px)': { slides: { perView: 1, spacing: 30 } },
					},
				},
				5: {
					slides: { perView: 5, spacing: 30 },
					breakpoints: {
						'(max-width: 1024px)': { slides: { perView: 3, spacing: 30 } },
						'(max-width: 680px)': { slides: { perView: 1, spacing: 30 } },
					},
				},
				6: {
					slides: { perView: 6, spacing: 30 },
					breakpoints: {
						'(max-width: 1024px)': { slides: { perView: 4, spacing: 30 } },
						'(max-width: 680px)': { slides: { perView: 1, spacing: 30 } },
					},
				},
			};

			const config = sliderConfigs[visibleSlides] || sliderConfigs[3];

			const sliderOptions = {
				loop: true,
				breakpoints: config.breakpoints,
				slides: config.slides,
			};

			let slider = new KeenSlider(elSlider, sliderOptions);

			const updateSlider = () => sliderController(slider, elementsArr, sliderOptions, slides);
			window.addEventListener('resize', updateSlider);
			updateSlider();

			if (navLeft) navLeft.addEventListener('click', () => slider.prev());
			if (navRight) navRight.addEventListener('click', () => slider.next());
		});
	}
}
