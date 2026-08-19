export default function debounce(fn, delay) {
	let timer = null;
	return function () {
		let context = this,
			args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			fn.apply(context, args);
		}, delay);
	};
}

//https://gist.github.com/ionurboz/51b505ee3281cd713747b4a84d69f434
