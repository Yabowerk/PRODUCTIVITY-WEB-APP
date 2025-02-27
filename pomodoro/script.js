let timer;
let isRunning = false;
let isPaused = false; // New variable to track pause state
let timeLeft;
let workTime = 25 * 60; // Default work time in seconds
let breakTime = 5 * 60; // Default break time in seconds
let isBreak = false;
let pomodoroCount = 0; // Counter for completed Pomodoro cycles

const timerDisplay = document.getElementById('timer-display');
const progressRing = document.getElementById('progress-ring');
const startBtn = document.getElementById('start-btn');
const pauseBtn = document.getElementById('pause-btn'); // Reference to pause button
const resetBtn = document.getElementById('reset-btn');
const workTimeInput = document.getElementById('work-time');
const breakTimeInput = document.getElementById('break-time');
const alarmSoundSelect = document.getElementById('alarm-sound');

function startTimer() {
    if (isRunning && !isPaused) return;

    workTime = parseInt(workTimeInput.value) * 60; // Update work time from input
    breakTime = parseInt(breakTimeInput.value) * 60; // Update break time from input

    timeLeft = isBreak ? breakTime : workTime;

    // Calculate initial dash offset
    const totalLength = Math.PI * (70 * 2); // Circumference of circle
    progressRing.setAttribute('stroke-dasharray', totalLength);
    progressRing.setAttribute('stroke-dashoffset', totalLength);

    if (!isRunning) {
        isRunning = true;
        isPaused = false; // Reset paused state when starting

        const updateInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(updateInterval);
                playAlarm();
                if (!isBreak) {
                    alert("Time's up! Take a break!");
                    isBreak = true; // Switch to break mode
                    pomodoroCount++; // Increment Pomodoro cycle count
                } else {
                    alert("Break's over! Time to work!");
                    isBreak = false; // Switch back to work mode
                }

                // Check if four Pomodoros have been completed
                if (pomodoroCount >= 4) {
                    alert("YOU HAVE SUCCESSFULLY COMPLETED YOUR POMODORO CYCLE");
                    pomodoroCount = 0; // Reset the count after displaying the message
                }

                resetTimer(); // Reset timer and prepare for next session
                return;
            }

            if (!isPaused) { // Only decrement time when not paused
                timeLeft--; // Decrease time left by 1 second
            }
            updateDisplay();
            updateProgress(totalLength);
        }, 1000); // Update every second
    }
}

function pauseTimer() {
    if (isRunning) {
        isPaused = !isPaused; // Toggle pause state

        if (isPaused) {
            pauseBtn.textContent = "Continue"; // Change button text to Continue
        } else {
            pauseBtn.textContent = "Pause"; // Change button text back to Pause
        }
    }
}

function updateDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = Math.floor(timeLeft % 60);

    timerDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
}

function updateProgress(totalLength) {
    const offset = totalLength - ((totalLength / (isBreak ? breakTime : workTime)) * timeLeft);
    progressRing.setAttribute('stroke-dashoffset', offset);
}

function resetTimer() {
    clearInterval(timer);
    isRunning = false;

    // Reset the display and progress ring
    timeLeft = isBreak ? breakTime : workTime; 
    updateDisplay();
    
    const totalLength = Math.PI * (70 * 2); // Circumference of circle
    progressRing.setAttribute('stroke-dashoffset', totalLength); // Reset progress

    pauseBtn.textContent = "Pause"; // Reset button text when timer resets
}

function playAlarm() {
    const selectedSound = alarmSoundSelect.value;

    const audioElement = new Audio(selectedSound);
    audioElement.play();
}

// Event listeners
startBtn.addEventListener('click', startTimer);
pauseBtn.addEventListener('click', pauseTimer); // Add event listener for pause button
resetBtn.addEventListener('click', resetTimer);

// Initial display update
updateDisplay();
