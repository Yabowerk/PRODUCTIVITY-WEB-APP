const trackerBody = document.getElementById('tracker-body');
const progressText = document.getElementById('progressText');
const progressChart = document.getElementById('progressChart');
const ctx = progressChart.getContext('2d');

// Load tasks from local storage on page load
document.addEventListener('DOMContentLoaded', loadTasks);

// Function to load tasks and update the habit tracker
function loadTasks() {
    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];

    tasks.forEach(task => {
        addToHabitTracker(task.text, task.completed);
    });

    updateProgress();
}

// Function to add task to habit tracker table
function addToHabitTracker(taskText, completed) {
    const row = document.createElement('tr');
    
    const cellTask = document.createElement('td');
    cellTask.textContent = taskText;

    const cellStatus = document.createElement('td');
    cellStatus.textContent = completed ? 'Completed' : 'Not Completed'; 

    row.appendChild(cellTask);
    row.appendChild(cellStatus);
    
    trackerBody.appendChild(row);
}

// Function to update completion status in habit tracker
function updateHabitTracker(taskText, completed) {
    const rows = trackerBody.querySelectorAll('tr');
    
    rows.forEach(row => {
        if (row.firstChild.textContent === taskText) {
            row.lastChild.textContent = completed ? 'Completed' : 'Not Completed';
        }
    });
}

// Function to update progress bar
function updateProgress() {
     const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
     const totalTasksCount = tasks.length;
     const completedTasksCount = tasks.filter(task => task.completed).length;

     let progressPercentage;
     if (totalTasksCount === 0) {
         progressPercentage = 0; 
     } else {
         progressPercentage = (completedTasksCount / totalTasksCount) * 100; 
     }

     drawProgressBar(progressPercentage);
}

// Function to draw progress bar on canvas
function drawProgressBar(percentage) {
     ctx.clearRect(0, 0, progressChart.width, progressChart.height);
     ctx.fillStyle = '#4CAF50';
     ctx.fillRect(0, 0, (percentage / 100) * progressChart.width, progressChart.height);

     ctx.fillStyle = '#ccc';
     ctx.fillRect((percentage / 100) * progressChart.width, 0, 
                  progressChart.width - (percentage / 100) * progressChart.width, 
                  progressChart.height);
}
