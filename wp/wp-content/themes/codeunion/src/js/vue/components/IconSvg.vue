<script setup>
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps(['src']);

const svg = ref(null);

axios
	.get(props.src)
	.then((response) => {
		svg.value = `${response.data}`;
	})
	.catch((error) => {
		console.error(error);
	});
</script>

<template>
	<span v-html="svg" class="iconSvg"></span>
</template>
