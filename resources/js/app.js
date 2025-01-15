import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('defaultModalButton').click();
});

document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('updateProductButton').click();
  });
