document.addEventListener('DOMContentLoaded', function() {
    const taskForm = document.getElementById('taskForm');
    const taskInput = document.getElementById('taskInput');
    const taskList = document.getElementById('taskList');
  
    // Load tasks from database on page load
    fetchTasks();
  
    taskForm.addEventListener('submit', function(event) {
      event.preventDefault();
      const taskText = taskInput.value.trim();
      if (taskText !== '') {
        addTask(taskText);
        taskInput.value = '';
      }
    });
  
    function fetchTasks() {
      fetch('backend/fetch_tasks.php')
        .then(response => response.json())
        .then(tasks => {
          taskList.innerHTML = '';
          tasks.forEach(task => {
            const li = document.createElement('li');
            li.textContent = task.text;
            const deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'dasfas';
            deleteBtn.className = 'delete-btn';
            deleteBtn.addEventListener('click', function() {
              deleteTask(task.id);
            });
            li.appendChild(deleteBtn);
            taskList.appendChild(li);
          });
        })
        .catch(error => console.error('Error:', error));
    }
  
    function addTask(text) {
      fetch('backend/add_task.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ text: text }),
      })
        .then(response => response.json())
        .then(() => fetchTasks())
        .catch(error => console.error('Error:', error));
    }
  
    function deleteTask(id) {
      fetch(`backend/delete_task.php?id=${id}`, {
        method: 'DELETE',
      })
        .then(() => fetchTasks())
        .catch(error => console.error('Error:', error));
    }
  });
  