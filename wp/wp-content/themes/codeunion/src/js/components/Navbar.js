import sanitizeInput from '../utils/sanitizeInput.js';

export default class Navbar {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: 'data-navbar',
			navMenu: 'data-menu',
			navElems: 'data-nav-elem',
			navTriggers: 'data-trigger',
			navSubmenus: 'data-submenu',
			activeAttr: 'data-active',
			ariaHiddenAttr: 'aria-hidden',
			ariaExpandedAttr: 'aria-expanded',
		};

		this.init = document.querySelectorAll(`[${this.settings.init}]`);
		if (this.init.length === 0) return false;

		this.setEvents();
	}

	setEvents() {
		this.init.forEach((navbar) => {
			let navMenu = navbar.querySelector(`[${this.settings.navMenu}]`);
			if (!navMenu) return;
			let navElems = navMenu.querySelectorAll(`[${this.settings.navElems}]`);
			if (!navElems) return;
			let navTriggers = navMenu.querySelectorAll(`[${this.settings.navTriggers}]`);

			if (navTriggers) {
				navTriggers.forEach((trigger) => {
					trigger.addEventListener('click', () => {
						const parentElem = trigger.parentElement;
						if (parentElem) {
							const submenu = parentElem.querySelector(`[${this.settings.navSubmenus}]`);
							let state = sanitizeInput(trigger.getAttribute(this.settings.ariaExpandedAttr));

							this.closeOtherSubmenus(navMenu, navElems, parentElem);

							if (submenu) {
								if (state === 'false') {
									parentElem.setAttribute(this.settings.activeAttr, 'true');
									trigger.setAttribute(this.settings.ariaExpandedAttr, 'true');
									submenu.setAttribute(this.settings.ariaHiddenAttr, 'false');
								} else {
									parentElem.setAttribute(this.settings.activeAttr, 'false');
									trigger.setAttribute(this.settings.ariaExpandedAttr, 'false');
									submenu.setAttribute(this.settings.ariaHiddenAttr, 'true');
								}
							}
						}
					});
				});
			}
			this.addClickOutsideListener(navMenu, navElems);
		});
	}

	closeOtherSubmenus(navMenu, navElems, exceptElem) {
		navElems.forEach((elem) => {
			if (elem !== exceptElem) {
				const submenu = elem.querySelector(`[${this.settings.navSubmenus}]`);
				const trigger = elem.querySelector(`[${this.settings.navTriggers}]`);
				if (submenu) {
					elem.setAttribute(this.settings.activeAttr, 'false');
					trigger.setAttribute(this.settings.ariaExpandedAttr, 'false');
					submenu.setAttribute(this.settings.ariaHiddenAttr, 'true');
				}
			}
		});
	}

	addClickOutsideListener(navMenu, navElems) {
		document.addEventListener('click', (event) => {
			const isClickInsideNav = navMenu.contains(event.target);
			const isClickInsideSubmenu = event.target.closest(`[${this.settings.navSubmenus}]`);
			const isClickOnTrigger = event.target.closest(`[${this.settings.navTriggers}]`);

			if (!isClickInsideNav || (isClickInsideNav && !isClickInsideSubmenu && !isClickOnTrigger)) {
				navElems.forEach((elem) => {
					const submenu = elem.querySelector(`[${this.settings.navSubmenus}]`);
					const trigger = elem.querySelector(`[${this.settings.navTriggers}]`);
					if (submenu) {
						elem.setAttribute(this.settings.activeAttr, 'false');
						trigger.setAttribute(this.settings.ariaExpandedAttr, 'false');
						submenu.setAttribute(this.settings.ariaHiddenAttr, 'true');
					}
				});
			}
		});
	}
}
