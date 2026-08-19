export function sliderController(slider, elementsArr, sliderOptions, slides) {
	const viewport = window.innerWidth;

	const breakpoints = Object.entries(sliderOptions.breakpoints || {})
		.map(([key, options]) => ({
			width: parseInt(key.match(/\d+/)[0], 10),
			options,
		}))
		.sort((a, b) => b.width - a.width);

	const activeBreakpoint = breakpoints.find((bp) => viewport <= bp.width)?.options || sliderOptions;
	const perView = activeBreakpoint.slides.perView;

	if (slides.length <= perView) {
		disableSlider(elementsArr, slider);
	} else {
		enableSlider(elementsArr, slider, sliderOptions);
	}
}

export function enableSlider(elementsArr, slider, sliderOptions) {
	elementsArr.forEach((el) => el.setAttribute('data-active', 'true'));
	setTimeout(() => slider.update(sliderOptions), 100);
}

export function disableSlider(elementsArr, slider) {
	slider.update({ disabled: true });
	elementsArr.forEach((el) => el.setAttribute('data-active', 'false'));
}
