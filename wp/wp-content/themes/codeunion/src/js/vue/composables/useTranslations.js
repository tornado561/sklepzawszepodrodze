import { ref } from 'vue';

const translations = ref({});

const fetchTranslations = async () => {
	try {
		const response = await fetch('/wp-json/custom/v1/translations');
		if (!response.ok) throw new Error('Błąd pobierania tłumaczeń');

		translations.value = await response.json();
	} catch (error) {
		console.error('Błąd pobierania tłumaczeń:', error);
	}
};

const t = (key) => translations.value[key] || key;

export function useTranslations() {
	return { translations, fetchTranslations, t };
}
