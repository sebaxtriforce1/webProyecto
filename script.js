document.addEventListener('DOMContentLoaded', (event) => {
    var dropdownButton = document.getElementById('dropdownMenuButton');
    var dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function() {
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-button')) {
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            }
        }
    });
});
