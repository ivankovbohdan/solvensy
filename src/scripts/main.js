'use strict';

document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('.contacts__form');

  form.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === 'success') {
          alert(data.message);
          form.reset();
        } else {
          alert(data.message);
        }
      })
      .catch(() => {
        alert('An error occurred. Please try again.');
      });
  });
});
