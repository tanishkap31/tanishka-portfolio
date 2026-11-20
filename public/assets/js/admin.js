/* Admin panel scripts */
(function () {
  'use strict';

  // Ask before deleting: any form with data-confirm="Question?" shows a confirmation first.
  document.addEventListener('submit', function (event) {
    var message = event.target.getAttribute('data-confirm');
    if (message && !window.confirm(message)) {
      event.preventDefault();
    }
  });

  // Show a preview of the picked image before it is uploaded.
  document.querySelectorAll('input[type="file"][data-preview]').forEach(function (input) {
    input.addEventListener('change', function () {
      var target = document.getElementById(input.getAttribute('data-preview'));
      var file = input.files && input.files[0];
      if (!target || !file || file.type.indexOf('image/') !== 0) return;
      target.src = URL.createObjectURL(file);
      target.hidden = false;
    });
  });
})();
