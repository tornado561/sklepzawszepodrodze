import GLightbox from 'glightbox';

import HeroVideo from './components/HeroVideo.js';
import ImageSliderSection from './components/ImageSliderSection.js';
import Navbar from './components/Navbar.js';
import NavbarMobile from './components/NavbarMobile.js';
import OfferSliderSection from './components/OfferSlider.js';
import PostToc from './components/PostToc.js';
import ProductCard from './components/ProductCard.js';
import SortComponent from './components/SortComponent.js';
import Testimonials from './components/Testimonials.js';

class Core {
	constructor() {
		new GLightbox();
		new ImageSliderSection();
		new Navbar();
		new NavbarMobile();
		new Testimonials();
		new PostToc();
		new SortComponent();
		new HeroVideo();
		new ProductCard();
		new OfferSliderSection();
	}
}

new Core();

// import { createApp } from 'vue'
// import App from './App.vue'
// import Background from './Background.vue'
//
//
// createApp(App).mount('[data-vue-app]');
// createApp(Background).mount('[data-vue-background]');
