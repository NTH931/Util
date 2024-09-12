<footer>
      <div id="notification-board"></div>
      <h6>Version 4.2.1 | <em>Util</em></h6>

      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <script type="module" src="js/utilities.js"></script>
      <script type="module" src="js/main.js"></script>
      <?php if (file_exists("./js/" . THIS_FILE . ".js")) : ?>
  <script src="js/<?= THIS_FILE ?>.js" type="module"></script>
      <?php endif; ?>

    </footer>
  <?= nl ?>