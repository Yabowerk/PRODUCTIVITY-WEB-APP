const taskInput = document.getElementById('task-input');
const addTaskBtn = document.getElementById('add-task-btn');
const taskList = document.getElementById('task-list');
const progressChart = document.getElementById('progress-chart');
const ctx = progressChart.getContext('2d');

// Load tasks from local storage on page load
document.addEventListener('DOMContentLoaded', loadTasks);

// Add task event
addTaskBtn.addEventListener('click', addTask);

// Add event listener for pressing Enter key
taskInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') { // Check if the pressed key is Enter
        addTask(); // Call the addTask function
    }
});

function addTask() {
    const taskText = taskInput.value.trim();
    
    if (taskText === '') {
        alert("Please enter a task.");
        return;
    }

    const li = document.createElement('li');
    li.setAttribute('draggable', true); // Make the task draggable

    // Generate a random color
    const randomColor = getRandomColor();
    li.style.backgroundColor = randomColor; // Set the background color of the list item

    // Create a span for task text
    const span = document.createElement('span');
    span.textContent = taskText;

    // Create a span for notes (initially empty)
    const notesSpan = document.createElement('span');
    notesSpan.className = 'notes'; // Class for styling
    notesSpan.textContent = localStorage.getItem(taskText + '_notes') || ''; // Load any existing notes

    // Create an input field for adding new notes
    const noteInput = document.createElement('input');
    noteInput.type = 'text';
    noteInput.placeholder = 'Add note...';
    
    // Button to save the note
    const saveNoteBtn = document.createElement('button');
    saveNoteBtn.textContent = 'Save Note';
    
    saveNoteBtn.addEventListener('click', () => {
        const newNote = noteInput.value.trim();
        if (newNote) {
            let existingNotes = localStorage.getItem(taskText + '_notes') || '';
            existingNotes += existingNotes ? ', ' + newNote : newNote;  // Append new note if there are existing ones.
            localStorage.setItem(taskText + '_notes', existingNotes);  // Save with unique key based on task text

            notesSpan.textContent = existingNotes;  // Update displayed notes next to the task.
            noteInput.value='';  // Clear input field after saving.
        } else {
            alert("Please enter a note.");
        }
    });

    // Create a label for the checkbox
    const label = document.createElement('label');
    label.className = 'checkbox'; // Add class for styling

    // Create a checkbox for marking completion
    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    
    checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
            span.classList.add('completed'); // Add completed class
        } else {
            span.classList.remove('completed'); // Remove completed class
        }
        saveTasks(); // Save tasks after changing completion status
        updateProgress(); // Update progress whenever a task is checked or unchecked
    });

   const deleteBtn = document.createElement('button');
   deleteBtn.innerHTML = '<i class="fas fa-trash"></i>'; // Use trash icon
   
   deleteBtn.addEventListener('click', (event) => {
       event.stopPropagation(); // Prevent click from bubbling up to li
       localStorage.removeItem(taskText + '_notes'); // Remove associated notes from localStorage
       localStorage.removeItem(taskText + '_reminder'); // Remove associated reminder from localStorage
       taskList.removeChild(li);
       saveTasks(); // Save tasks after deletion
       updateProgress(); // Update progress after deletion
   });

   // Create an input field for setting reminders
   const reminderInput = document.createElement("input");
   reminderInput.type= "datetime-local";
   reminderInput.value= localStorage.getItem(taskText + "_reminder") || "";  // Load any existing reminder

   const setReminderBtn= document.createElement("button");
   setReminderBtn.innerHTML= "Set Reminder";

   setReminderBtn.addEventListener("click", () => {
       if(reminderInput.value){
           localStorage.setItem(taskText+ "_reminder", reminderInput.value);
           alert("Reminder set!");
       }else{
           alert("Please select a valid date and time.");
       }
   });

   li.appendChild(label);  // Append label containing the checkbox to li
   li.appendChild(checkbox);  // Append checkbox to li
   li.appendChild(span);
   li.appendChild(notesSpan); // Append notes span to li
   li.appendChild(noteInput);  // Append input field for new notes to li
   li.appendChild(saveNoteBtn);  // Append button to save new note to li
   li.appendChild(reminderInput);  // Append input field for reminders to li 
   li.appendChild(setReminderBtn);  // Append button to set reminders to li 
   li.appendChild(deleteBtn);  // Append delete button
    
   taskList.appendChild(li); // Append the new task to the list
    
   taskInput.value = ''; // Clear input field
   saveTasks(); // Save tasks after adding new one...
   setupDragAndDrop(li);  // Set up drag and drop functionality for this new task.
   
   updateProgress();  // Update progress whenever a new task is added.
}

function setupDragAndDrop(li) {
   li.addEventListener("dragstart", () => {
      li.classList.add("dragging");
   });

   li.addEventListener("dragend", () => {
      li.classList.remove("dragging");
   });

   taskList.addEventListener("dragover", (event) => {
      event.preventDefault();
      const draggingLi = document.querySelector(".dragging");
      const siblings =
         [...taskList.querySelectorAll("li:not(.dragging)")];
         
      let nextSibling =
         siblings.find((sibling) =>
            event.clientY <= sibling.getBoundingClientRect().top +
            sibling.offsetHeight / 2);

      if (!nextSibling) { 
         nextSibling =
            siblings[siblings.length - 1]; 
      }

      taskList.insertBefore(draggingLi, nextSibling);
      saveTasks();  
     });
}

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

     // Update table values
     document.getElementById('total-tasks').textContent = totalTasksCount;
     document.getElementById('completed-tasks').textContent = completedTasksCount;
     document.getElementById('progress-percentage').textContent = `${Math.round(progressPercentage)}%`;

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

function getRandomColor() {
   const letters = '0123456789ABCDEF';
   let color = '#';
   for (let i = 0; i < 6; i++) {
       color += letters[Math.floor(Math.random() * 16)];
   }
   return color;
}

function saveTasks() {
     const tasks = [];
     
     document.querySelectorAll('#task-list li').forEach(li => {
         const taskText = li.querySelector('span').textContent;
         const isCompleted = li.querySelector('input[type="checkbox"]').checked;

         tasks.push({ text: taskText, completed: isCompleted });
     });

     localStorage.setItem('tasks', JSON.stringify(tasks)); 
}

function loadTasks() {
     const tasks = JSON.parse(localStorage.getItem('tasks')) || [];

     tasks.forEach(task => {
         const li = document.createElement('li');

         const randomColor = getRandomColor();
         li.style.backgroundColor = randomColor; 

         const span = document.createElement('span');
         span.textContent = task.text;

         const notesSpan = document.createElement('span');
         notesSpan.className ='notes'; 
         notesSpan.textContent= localStorage.getItem(task.text + '_notes') || '';

         const checkbox= document.createElement("input");
         checkbox.type= "checkbox";
         checkbox.checked= task.completed;

         if(task.completed){
             span.classList.add("completed");
         }

         checkbox.addEventListener("change", () => {

             if(checkbox.checked){
                 span.classList.add("completed");
             }else{
                 span.classList.remove("completed");
             }

             saveTasks();
             updateProgress(); 
             
         });

         const deleteBtn= document.createElement("button");
         deleteBtn.innerHTML= '<i class="fas fa-trash"></i>';

         deleteBtn.addEventListener("click", (event) => {

             event.stopPropagation();
             localStorage.removeItem(task.text + "_notes");
             localStorage.removeItem(task.text + "_due_date");
             localStorage.removeItem(task.text + "_reminder");
             taskList.removeChild(li);
             saveTasks();
             updateProgress(); 
             
         });

      const reminderInput= document.createElement("input");
      reminderInput.type= "datetime-local";
      reminderInput.value= localStorage.getItem(task.text + "_reminder") || "";

      const setReminderBtn= document.createElement("button");
      setReminderBtn.innerHTML= "Set Reminder";

      setReminderBtn.addEventListener("click", () => {

          if(reminderInput.value){
              localStorage.setItem(task.text+ "_reminder", reminderInput.value);
              alert("Reminder set!");
          }else{
              alert("Please select a valid date and time.");
          }
      });

      li.appendChild(checkbox);
      li.appendChild(span);
      li.appendChild(notesSpan); 
      li.appendChild(reminderInput);
      li.appendChild(setReminderBtn);

      setupDragAndDrop(li); 

      taskList.appendChild(li); 
   });
}
