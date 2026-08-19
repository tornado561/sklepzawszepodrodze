import sanitizeInput from '../utils/sanitizeInput.js';

export default class NavbarMobile {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: 'data-header',
			trigger: 'data-mobile-nav-trigger',
			menu: 'data-navbar-mob',
			navMenu: 'data-menu-mob',
			navElems: 'data-nav-elem',
			navTriggers: 'data-trigger',
			navSubmenus: 'data-submenu',
			activeAttr: 'data-active',
			ariaHiddenAttr: 'aria-hidden',
			ariaExpandedAttr: 'aria-expanded',
		};

		this.init = document.querySelectorAll(`[${this.settings.init}]`);
		if (this.init.length === 0) return;

		this.setEvents();
	}

	setEvents() {
		this.init.forEach((header) => {
			const trigger = header.querySelector(`[${this.settings.trigger}]`);
			const menu = header.querySelector(`[${this.settings.menu}]`);
			const navMenu = header.querySelector(`[${this.settings.navMenu}]`);
			if (!menu || !navMenu) return;

			const navElems = navMenu.querySelectorAll(`[${this.settings.navElems}]`);
			const navTriggers = navMenu.querySelectorAll(`[${this.settings.navTriggers}]`);

			if (trigger && menu) {
				trigger.addEventListener('click', () => {
					const state = trigger.getAttribute(this.settings.activeAttr);
					if (state === 'true') {
						this.closeMenu(trigger, menu, navElems);
					} else {
						this.openMenu(trigger, menu);
					}
				});

				document.addEventListener('click', (e) => {
					const menuState = menu.getAttribute(this.settings.activeAttr);
					if (menuState === 'true' && !menu.contains(e.target) && !trigger.contains(e.target)) {
						this.closeMenu(trigger, menu, navElems);
					}
				});

				navMenu.addEventListener('click', (e) => {
					const link = e.target.closest('a[href]');
					if (!link) return;
					if (link.closest(`[${this.settings.navTriggers}]`)) return;
					this.closeMenu(trigger, menu, navElems);
				});
			}

			if (navTriggers && navTriggers.length) {
				navTriggers.forEach((subTrigger) => {
					subTrigger.addEventListener('click', (evt) => {
						if (
							subTrigger.tagName === 'A' &&
							(!subTrigger.getAttribute('href') || subTrigger.getAttribute('href') === '#')
						) {
							evt.preventDefault();
						}

						const parentElem = subTrigger.parentElement;
						if (!parentElem) return;

						const submenu = parentElem.querySelector(`[${this.settings.navSubmenus}]`);
						const state = sanitizeInput(parentElem.getAttribute(this.settings.ariaExpandedAttr));

						this.closeOtherSubmenus(navElems, parentElem);

						if (submenu) {
							if (state === 'false') {
								parentElem.setAttribute(this.settings.ariaExpandedAttr, 'true');
								submenu.setAttribute(this.settings.ariaHiddenAttr, 'false');
							} else {
								parentElem.setAttribute(this.settings.ariaExpandedAttr, 'false');
								submenu.setAttribute(this.settings.ariaHiddenAttr, 'true');
							}
						}
					});
				});
			}
		});
	}

	closeOtherSubmenus(navElems, exceptElem) {
		navElems.forEach((elem) => {
			if (elem !== exceptElem) {
				const submenu = elem.querySelector(`[${this.settings.navSubmenus}]`);
				if (submenu) {
					elem.setAttribute(this.settings.ariaExpandedAttr, 'false');
					submenu.setAttribute(this.settings.ariaHiddenAttr, 'true');
				}
			}
		});
	}

	openMenu(trigger, menu) {
		trigger.setAttribute(this.settings.activeAttr, 'true');
		trigger.setAttribute(this.settings.ariaExpandedAttr, 'true');
		menu.setAttribute(this.settings.activeAttr, 'true');
		menu.setAttribute(this.settings.ariaHiddenAttr, 'false');
	}

	closeMenu(trigger, menu, navElems) {
		trigger.setAttribute(this.settings.activeAttr, 'false');
		trigger.setAttribute(this.settings.ariaExpandedAttr, 'false');
		menu.setAttribute(this.settings.activeAttr, 'false');
		menu.setAttribute(this.settings.ariaHiddenAttr, 'true');

		if (navElems && navElems.length) {
			navElems.forEach((elem) => {
				const submenu = elem.querySelector(`[${this.settings.navSubmenus}]`);
				if (submenu) {
					elem.setAttribute(this.settings.ariaExpandedAttr, 'false');
					submenu.setAttribute(this.settings.ariaHiddenAttr, 'true');
				}
			});
		}
	}
}
