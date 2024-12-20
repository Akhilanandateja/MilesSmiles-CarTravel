window.addEventListener('DOMContentLoaded', () => {
    const lines = [
        "FrontEnd Development.",
        "BackEnd Development.",
        "Data Structures & Algorithms.",
        "Problem Solving.",
        "Machine Learning & AI."
       
    ];
    const typedLine = document.getElementById('typed-line');
    let lineIndex = 0;
    function typeText(text, callback) {
        let charIndex = 0;
        typedLine.style.width = "0"; // Reset width for typing effect
        // Typing effect
        const typingInterval = setInterval(() => {
            typedLine.textContent = text.slice(0, charIndex + 1);
            charIndex++;
            typedLine.style.width = `${charIndex}ch`; // Dynamically set width based on characters
            if (charIndex === text.length) {
                clearInterval(typingInterval);
                setTimeout(callback, 1500); // Pause before replacing with next line
            }
        }, 100); // Typing speed
    }
    function startTypingEffect() {
        typeText(lines[lineIndex], () => {
            lineIndex = (lineIndex + 1) % lines.length; // Loop back to the first line
            startTypingEffect(); // Recursively call the next typing effect
        });
    }
    // Start the typing effect
    startTypingEffect();
});