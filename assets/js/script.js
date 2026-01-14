document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('openAddTask');
    const closeBtn = document.getElementById('closeAddTask');
    const form = document.getElementById('addTaskForm');

    openBtn.addEventListener('click', () => {
        console.log("test");
        form.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        console.log("test");
        form.style.display = 'none';
    });
});