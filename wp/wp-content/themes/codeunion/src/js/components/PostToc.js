import { sanitizeForId } from '../utils/sanitizeForId.js';

export default class PostToc {
	constructor() {
		this.setVars();
	}

	setVars() {
		this.settings = {
			init: 'data-single-content',
			tocBox: 'data-toc',
			tocContent: 'data-toc-content',
			blocksContent: 'data-blocks',
			contentTitles: 'h2, h3',
		};

		this.init = document.querySelector(`[${this.settings.init}]`);
		if (!this.init) return false;
		this.setEvents();
	}

	setEvents() {
		const tocBox = document.querySelector(`[${this.settings.tocBox}]`);
		const tocContent = document.querySelector(`[${this.settings.tocContent}]`);
		const blocksContent = document.querySelector(`[${this.settings.blocksContent}]`);
		if (!blocksContent || !tocContent) return;

		const headings = blocksContent.querySelectorAll(this.settings.contentTitles);
		if (!headings.length) return;

		const tocData = this.buildTocData(headings);
		const tocList = this.generateTocList(tocData);

		tocContent.innerHTML = '';
		tocContent.appendChild(tocList);

		tocContent.querySelectorAll('a[href^="#"]').forEach((link) => {
			link.addEventListener('click', (event) => {
				event.preventDefault();
				const targetId = link.getAttribute('href').split('#')[1];
				const targetElement = document.getElementById(targetId);

				if (targetElement) {
					const offset = 120;
					const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;

					window.scrollTo({
						top: elementPosition - offset,
						behavior: 'smooth',
					});

					history.pushState(null, null, `#${targetId}`);
				}
			});
		});

		if (tocBox) {
			tocBox.setAttribute('data-active', 'true');
			tocBox.setAttribute('aria-hidden', 'false');
		}
	}

	buildTocData(headings) {
		const toc = [];
		let currentH2 = null;
		let counter = 1;

		headings.forEach((heading) => {
			const text = heading.textContent.trim();
			const id = counter + '-' + sanitizeForId(text);
			heading.id = id;
			counter++;

			if (heading.tagName === 'H2') {
				currentH2 = { text, id, children: [] };
				toc.push(currentH2);
			} else if (heading.tagName === 'H3' && currentH2) {
				currentH2.children.push({ text, id });
			}
		});

		return toc;
	}

	generateTocList(tocData) {
		const ul = document.createElement('ul');
		ul.classList.add('singleContent__tocList');

		tocData.forEach((h2Item) => {
			const li = document.createElement('li');
			li.classList.add('singleContent__tocItem');
			const a = document.createElement('a');
			a.classList.add('singleContent__tocLink');
			a.href = `#${h2Item.id}`;
			a.textContent = h2Item.text;
			li.appendChild(a);

			if (h2Item.children.length > 0) {
				const subUl = document.createElement('ul');
				subUl.classList.add('singleContent__tocSubList');

				h2Item.children.forEach((h3Item) => {
					const subLi = document.createElement('li');
					subLi.classList.add('singleContent__tocSubItem');
					const subA = document.createElement('a');
					subA.classList.add('singleContent__tocSubLink');
					subA.href = `#${h3Item.id}`;
					subA.textContent = h3Item.text;
					subLi.appendChild(subA);
					subUl.appendChild(subLi);
				});

				li.appendChild(subUl);
			}

			ul.appendChild(li);
		});

		return ul;
	}
}
