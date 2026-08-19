<script setup>
import { defineProps } from 'vue';

const props = defineProps({
	title: String,
	url: String,
	target: String,
});
</script>

<template>
	<a :href="props.url" :target="props.target || undefined">{{ props.title }}</a>
</template>
