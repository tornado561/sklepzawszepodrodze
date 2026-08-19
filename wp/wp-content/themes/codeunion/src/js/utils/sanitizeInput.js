export default function sanitizeInput(input) {
	return input.replace(/[<>]/g, '');
}
