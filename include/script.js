document.addEventListener('DOMContentLoaded', function() {
const sizeButtons = document.querySelectorAll('.size-button');
const stokSize = document.getElementById('stokValue');
const id = document.getElementById('Id').value;

sizeButtons.forEach(button => {
    button.addEventListener('click', () => {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                stokSize.innerHTML = xhr.responseText;
            }
        };
        const selectedSize = button.getAttribute('data-size');
        xhr.open('GET', `getStok.php?size=${encodeURIComponent(selectedSize)}&Id=${encodeURIComponent(id)}`, true);
        xhr.send();
    });
});
});
