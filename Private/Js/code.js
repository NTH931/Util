import * as obj from './Functions.js';

document.addEventListener('DOMContentLoaded', function() {
});


// Update buttons
document.addEventListener('DOMContentLoaded', function() {
  // Adds the Event handlers for the function
  function setupLinkStorage(inputClass, storeButtonClass, storedLinkButtonId, storageKey, innerText) {
      var input = document.getElementById(inputClass);
      var storeButton = document.querySelector('.' + storeButtonClass);
      var storedLinkButton = document.getElementById(storedLinkButtonId);

      // Function to store the link
      function storeLink() {
          var linkInput = input.value.trim();
          if (linkInput !== '') {
              storedLinkButton.href = linkInput; // Update the href attribute
              storedLinkButton.innerText = innerText;
              storedLinkButton.disabled = false;
              localStorage.setItem(storageKey, linkInput);
          }
      }

      // Function to retrieve and display the stored link
      function displayStoredLink() {
          var storedLink = localStorage.getItem(storageKey);
          if (storedLink) {
              storedLinkButton.setAttribute('href', storedLink);
              storedLinkButton.innerText = innerText;
              storedLinkButton.disabled = false;
              storedLinkButton.classList.remove('disabled-button'); // Remove the disabled class
          } else {
              storedLinkButton.innerText = 'No Link Stored';
              storedLinkButton.disabled = true;
              storedLinkButton.classList.add('disabled-button'); // Add the disabled class
          }
      }

      // Setup event listeners
      storeButton.addEventListener('click', storeLink);

      // Initialize
      displayStoredLink();
  }

  // Setup all instances
  setupLinkStorage('linkInput1', 'storeButton1', 'storedLinkButton1', 'storedLink1', 'HuiAko');
  setupLinkStorage('linkInput2', 'storeButton2', 'storedLinkButton2', 'storedLink2', 'Intergrated Studies');
  setupLinkStorage('linkInput3', 'storeButton3', 'storedLinkButton3', 'storedLink3', 'Aotearoa Histories');
  setupLinkStorage('linkInput4', 'storeButton4', 'storedLinkButton4', 'storedLink4', 'Science');
  setupLinkStorage('linkInput5', 'storeButton5', 'storedLinkButton5', 'storedLink5', 'Maths');
  setupLinkStorage('linkInput6', 'storeButton6', 'storedLinkButton6', 'storedLink6', 'Health and PE');

  // Reset all links
  document.getElementById('resetButton').addEventListener('click', function() {
    localStorage.removeItem('storedLink1');
    localStorage.removeItem('storedLink2');
    localStorage.removeItem('storedLink3');
    localStorage.removeItem('storedLink4');
    localStorage.removeItem('storedLink5');
    localStorage.removeItem('storedLink6');

    var storedLinkButtons = document.querySelectorAll('#storedLinkButton1, #storedLinkButton2, #storedLinkButton3, #storedLinkButton4, #storedLinkButton5, #storedLinkButton6');
    storedLinkButtons.forEach(function(button) {
        button.innerText = 'No Link Stored';
        button.disabled = true;
    });
  });
});