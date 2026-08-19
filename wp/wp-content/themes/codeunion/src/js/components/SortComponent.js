export default class SortComponent {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: 'data-sort-component',
			select: 'data-select',
		};

		this.init = document.querySelectorAll(`[${this.settings.init}]`);
		if (this.init.length === 0) return false;

		this.setEvents();
	}

	setEvents() {
		this.init.forEach((el) => {
			const select = el.querySelector(`[${this.settings.select}]`);

			if (select) {
				select.addEventListener('change', () => {
					const sortValue = select.value;
					const url = new URL(window.location.href);

					if (sortValue === 'asc') {
						url.searchParams.set('sort', 'asc');
					} else {
						url.searchParams.delete('sort');
					}

					window.location.href = url.toString();
				});
			}
		});
	}
}
