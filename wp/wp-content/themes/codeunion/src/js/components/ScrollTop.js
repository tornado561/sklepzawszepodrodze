export default class ScrollTop {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			button: 'data-scrolltop',
		};

		this.scrollTopBtn = document.querySelector(`[${this.settings.button}]`);
		if (!this.scrollTopBtn) return false;

		this.setEvents();
	}

	setEvents() {
		this.scrollTopBtn.addEventListener('click', () => {
			window.scrollTo({
				top: 0,
				behavior: 'smooth',
			});
		});
	}
}
