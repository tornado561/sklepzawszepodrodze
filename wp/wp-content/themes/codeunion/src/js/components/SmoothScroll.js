import sanitizeInput from '@/js/functions/sanitizeInput';

export default class SmoothScroll {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.navItems = document.querySelectorAll(`a[href^="#"]`);
		if (!this.navItems) return false;

		this.setEvents();
	}

	setEvents() {
		this.navItems.forEach((link) => {
			link.addEventListener('click', (event) => {
				event.preventDefault();
				this.handleNavigation(link);
			});

			link.addEventListener('keydown', (event) => {
				if (event.key === ' ' || event.key === 'Enter') {
					event.preventDefault();
					this.handleNavigation(link);
				}
			});
		});
	}

	handleNavigation(link) {
		let targetId = sanitizeInput(link.getAttribute('href').split('#')[1]);
		let targetElement = document.querySelector(`#${targetId}`);

		if (targetElement) {
			const offset = 80;
			const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;

			window.scrollTo({
				top: elementPosition - offset,
				behavior: 'smooth',
			});

			history.pushState(null, null, `#${targetId}`);
		}
	}
}
