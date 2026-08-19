export default class ProductCard {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			card: '.product-card',
			inner: '.product-card__inner',
			flippedClass: 'is-flipped',
			cta: '.product-card__cta-link',
		};

		this.cards = document.querySelectorAll(this.settings.card);
		if (!this.cards.length) return false;

		this.setEvents();
	}

	setEvents() {
		this.cards.forEach((card) => {
			card.addEventListener('click', (e) => {
				if (e.target.closest(this.settings.cta)) {
					return;
				}

				this.toggleFlip(card);
			});
		});
	}

	toggleFlip(card) {
		card.classList.toggle(this.settings.flippedClass);
	}
}
