<<<<<<< HEAD
<?php
require "Includes/header.php";
?>
=======
<!DOCTYPE html>
<html lang="en">
    <?php
  require "Includes/header.php";
  //require_once "Includes/process.php"; 
  ?>
  <body>
>>>>>>> 21276100a7496e93e1737a23934a634c49fac588
    <textarea id="textarea">
    </textarea>
    <script>
      const textarea = document.getElementById('myTextarea');

      // Load the saved content from local storage, if available
      const savedContent = localStorage.getItem('textareaContent');
      if (savedContent) {
        textarea.value = savedContent;
      }

      // Save the content to local storage whenever it changes
      textarea.addEventListener('keypress', function() {
        localStorage.setItem('textareaContent', this.value);
      });

      textarea.addEventListener('keydown', function(event) {
        if (event.key === 'Tab') {
          event.preventDefault(); // Prevent the default tab behavior

          // Insert 4 spaces at the current cursor position
          const start = this.selectionStart;
          const end = this.selectionEnd;
          const spaces = '    '; // 4 spaces
          this.value = this.value.substring(0, start) + spaces + this.value.substring(end);

          // Move the cursor to after the inserted spaces
          this.selectionStart = this.selectionEnd = start + spaces.length;
            }
          });
    </script>
  </body>
</html>
