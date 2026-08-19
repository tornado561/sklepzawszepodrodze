export default class StickyHeader {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			header: 'data-header',
			stickyAttr: 'data-sticky',
		};

		this.header = document.querySelector(`[${this.settings.header}]`);
		if (!this.header) return false;

		this.setEvents();
	}

	setEvents() {
		// let headerOffset = this.header.offsetTop;
		let headerOffset = 20;

		const sticker = () => {
			if (window.pageYOffset > headerOffset) {
				this.setStickyState(this.header, 'true');
			} else {
				this.setStickyState(this.header, 'false');
			}
		};

		if (window.pageYOffset > headerOffset) {
			this.setStickyState(this.header, 'true');
		}

		window.onscroll = function () {
			sticker();
		};
	}

	setStickyState(elem, value) {
		elem.setAttribute(this.settings.stickyAttr, value);
	}
}
