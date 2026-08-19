import KeenSlider from 'keen-slider';

import { sliderController } from '../utils/sliderController';

export default class TestimonialsSlider {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: 'data-testimonials',
			slider: 'data-slider',
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

			const navLeft = el.querySelector(`[${this.settings.navLeft}]`);
			const navRight = el.querySelector(`[${this.settings.navRight}]`);
			const slides = elSlider.querySelectorAll('.keen-slider__slide');

			const elementsArr = [elSlider, navLeft, navRight].filter(Boolean);

			const sliderOptions = {
				loop: true,
				breakpoints: {
					'(max-width: 1024px)': { slides: { perView: 1, spacing: 0 } },
					'(max-width: 680px)': { slides: { perView: 1, spacing: 0 } },
				},
				slides: { perView: 1, spacing: 0 },
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
