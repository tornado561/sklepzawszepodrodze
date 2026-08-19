export default class HeroScroll {
	constructor() {
		this.settings = {
			button: 'data-hero-scroll',
		};

		this.buttons = document.querySelectorAll(`[${this.settings.button}]`);

		if (this.buttons.length === 0) {
			return;
		}

		this.setEvents();
	}

	setEvents() {
		this.buttons.forEach((button) => {
			button.addEventListener('click', () => {
				const hero = button.closest('.hero');
				const target = hero?.nextElementSibling;

				if (!target) {
					return;
				}

				// 80px = fixed header height
				const top = target.getBoundingClientRect().top + window.scrollY - 80;
				const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

				window.scrollTo({
					top,
					behavior: prefersReducedMotion ? 'auto' : 'smooth',
				});
			});
		});
	}
}
