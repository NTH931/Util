<div id="settings">
  <?php 
    require_once 'CSS/css-functions.php'; 
  ?>
  <style>
    .switch {
      z-index: 0;
      text-decoration: none;
      position: relative;
      display: inline-flex;
      align-items: center;
      padding: 2px;
      padding-left: 10px;
      margin: 4px 0;
      width: auto; /* Allow width to be auto to fit content */
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .switch .slider {
      position: relative;
      width: 31px;
      height: 17px;
      background-color: var(--background-color-ll);
      border-radius: 25px;
      cursor: pointer;
      margin: 0 10px;
      transition: background-color 0.3s;
    }

    .switch .slider::before {
      content: "";
      position: absolute;
      width: 12px;
      height: 12px;
      background-color: #aaa;
      border-radius: 50%;
      top: 2px;
      left: 2px;
      transition: transform 0.3s;
    }

    .switch input:checked + .slider {
      background-color: var(--green);
    }

    .switch input:checked + .slider::before {
      transform: translateX(24px); /* Adjust according to slider width */
    }

    label {
      padding: 5px 10px;
      display: inline-flex;
      align-items: center;
      background-color: var(--background-color-l);
      width: 100%;
    }

    select {
      width: 50% !important;
      position: relative;
    }

    .dropdown {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .parent {
      position: relative;
      width: 100%;
    }

    .inline {
      display: inline-block;
    }

  </style>
  <?php 
    require_once 'variables.php';
    function current_setting_s(string $cookieName, string|bool $testValue) {
      $settingsCookie = json_decode($_COOKIE["settings"], true);
      return isset($settingsCookie[$cookieName]) && $settingsCookie[$cookieName] == $testValue ? "selected" : '';
    }

    function current_setting_c(string $cookieName, string|bool $testValue) {
      $settingsCookie = json_decode($_COOKIE["settings"], true);
      return isset($settingsCookie[$cookieName]) && $settingsCookie[$cookieName] == $testValue ? "checked" : '';
    }
    function switch_element(string $text, string $name, string|bool $checkValue) {
      $checked = $checkValue ? "checked" : "";
      return <<<HTML
      <label class="switch">
        <b>$text:</b>
        <input type="checkbox" id="$name" name="$name" value="1" $checked>
        <span class="slider"></span>
      </label><br>
      HTML;
    }
  ?>
  <form id="settings-form" name="settings-form" action="../Private/PHP/cookies.php" method="post">
    <label class="set">
      <b>Base Color:</b>
      <select name="Base-Color">
        <option value="red" <?= current_setting_s("Base-Color", "red") ?>><b>Red</b></option>
        <option value="orange" <?= current_setting_s("Base-Color", "orange") ?>><b>Orange</b></option>
        <option value="yellow" <?= current_setting_s("Base-Color", "yellow") ?>><b>Yellow</b></option>
        <option value="green" <?= current_setting_s("Base-Color", "green") ?>><b>Green</b></option>
        <option value="blue" <?= current_setting_s("Base-Color", "blue") ?>><b>Blue</b> - Default</option>
        <option value="purple" <?= current_setting_s("Base-Color", "purple") ?>><b>Purple</b></option>
      </select>
    </label>

    <label class="set">
      <b>Notifications:</b>
      <select name="Notifications" name="Notifications">
        <option value="1" <?= current_setting_s("Notifications", "1") ?>>All - Default (Popup)</option>
        <option value="2" <?= current_setting_s("Notifications", "2") ?>>Important Only (Popup)</option>
        <option value="3" <?= current_setting_s("Notifications", "3") ?>>Notification Panel Only</option>
      </select>
    </label>
    <?= switch_element("Tooltips", "tooltips", current_setting_c("Tooltips", true)) ?>
    <dropdown label="Buttons" class="parent">
    <?php
      ##################
      ## DON'T CHANGE ##
      ##################
      $file = json_decode(file_get_contents("../Private/JSON/lists.json"), true);
      $cookie = json_decode($_COOKIE["settings"], true)["Buttons"] ?? [];

      // Check if 'Buttons' key exists and is an array
      if (isset($file['ButtonsObj']) && is_array($file['ButtonsObj'])) {
        // Iterate over the buttons associative array
        foreach ($file['ButtonsObj'] as $button => $value) {
          $modifiers = trim(substr_slice(end, $value, "!"));

          if ($modifiers === "unswitchable" || $modifiers === "unavaliable") continue;

          $specialButton = htmlspecialchars($button);
          $specialValue  = htmlspecialchars(trim(substr_slice(start, $value, "!")));
          $checked       = isset($cookie[$button]) ? ($cookie[$button] ? "checked" : "") : "";

          echo <<<HTML
          <label class="switch">
            $specialValue:
            <input type="checkbox" id="$specialButton" name="Buttons[$specialButton]" value="1" $checked>
            <span class="slider"></span>
          </label><br>
          HTML;
        }
      }
    ?>
    </dropdown>
    <input type="submit" value="Submit">
    <input type="button" class="inline" onclick="$('#settings').hide()" value="Exit">
  </form>
</div>