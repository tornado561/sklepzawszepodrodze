const {spawn} = require('child_process');

console.log("\x1b[92m------------------------------------\x1b[0m");
console.log("\x1b[92m| \x1b[4m\x1b[33mVite dev server by\x1b[96m CodeUnion.dev\x1b[0m \x1b[92m|\x1b[0m");
console.log("\x1b[92m| Author: Szymon Konieczny         |\x1b[0m");
console.log("\x1b[92m| Version: 2.1.37                  |\x1b[0m");
console.log("\x1b[92m------------------------------------\x1b[0m");

// Create hotfile
spawn('npm', ['run', 'make-hotfile'], {stdio: 'inherit'});
console.log("\x1b[35mHotfile created!\x1b[0m");

// Start the Vite development server
const viteProcess = spawn('npm', ['run', 'development'], {
	stdio: 'inherit',
	shell: true
});
console.log("\x1b[35mVite started!\x1b[0m");

// Function to clean up when stopping
const cleanup = () => {
	console.log("\x1b[31mStopping Vite and deleting hotfile...\x1b[0m");

	if (viteProcess) {
		viteProcess.kill('SIGINT'); // Send SIGINT to Vite
	}

	// Run delete-hotfile script and wait for it to finish
	const deleteHotfileProcess = spawn('npm', ['run', 'delete-hotfile'], {stdio: 'inherit'});

	deleteHotfileProcess.on('exit', () => {
		console.log("\x1b[31mHotfile deleted! Exiting...\x1b[0m");
		process.exit(0); // Exit cleanly without error 130
	});
};

// Handle Ctrl+C (SIGINT)
process.on('SIGINT', cleanup);

// Handle Vite process exit
viteProcess.on('exit', (code) => {
	console.log('\x1b[35mVite process exited with code:', code, '\x1b[0m');

	if (code !== 0) {
		console.log("\x1b[31mVite crashed! Deleting hotfile...\x1b[0m");
		cleanup();
	}
});
