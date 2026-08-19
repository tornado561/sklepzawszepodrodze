export function sanitizeForId(text) {
	return text
		.normalize('NFD') // rozbija znaki diakrytyczne
		.replace(/[\u0300-\u036f]/g, '') // usuwa diakrytyki (np. ą -> a)
		.replace(/[^a-zA-Z0-9\s-]/g, '') // usuwa znaki specjalne
		.trim()
		.toLowerCase()
		.replace(/\s+/g, '-'); // spacje na myślniki
}
