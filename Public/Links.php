<!DOCTYPE html>
 </html>
    <?php require "Includes/header.php"; ?>
    <style>
        /* Your CSS styles here */
        head, body {
            overflow-y: auto;
            overflow-x: auto;
        }
        div {
            width: 300px;
            clear: both;
            white-space: nowrap;
        }

        div > label, div > input, div > button, div > span {
            clear: both;
            margin-left: 2px;
        }

        body {
            overflow-y: scroll;
            overflow-y: hidden;
        }

        input {
            border-radius: 7.5px;
            cursor: text;
        }
    </style>
<body>
    <!-- Your HTML content here -->
    <h1>Links</h1>
    <hr>
    <br>
    <!--HuiAko-->
    <div>
        <label style="margin-left: 40px; margin-right: 39px;" for="linkInput1"><b>HuiAko: </b></label>
        <input style="cursor: text;" type="text" id="linkInput1" class="linkInput1 buttonStyle">
        <button class="storeButton1">Store Link</button>
        <a target="_blank" id="storedLinkButton1" class="spanA storedLinkButton">No Link Stored</a>
    </div>
    <br>
    <!--Intergrated Studies-->
    <div>
        <label for="linkInput2"><b>Intergrated Studies: </b></label>
        <input style="cursor: text;" type="text" id="linkInput2" class="linkInput2 buttonStyle">
        <button class="storeButton2">Store Link</button>
        <a target="_blank" id="storedLinkButton2" class="spanA storedLinkButton">No Link Stored</a>
    </div>
    <br>
    <!--Aotearoa Histories-->
    <div>
        <label style="margin-left: 5px; margin-right: 5px;" for="linkInput3"><b>Aotearoa histories: </b></label>
        <input style="cursor: text;" type="text" id="linkInput3" class="linkInput3 buttonStyle">
        <button class="storeButton3">Store Link</button>
        <a target="_blank" id="storedLinkButton3" class="spanA storedLinkButton">No Link Stored</a>
    </div>
    <br>
    <!--Science-->
    <div>
        <label style="margin-left: 41px; margin-right: 42px;" for="linkInput4"><b>Science: </b></label>
        <input style="cursor: text;" type="text" id="linkInput4" class="linkInput4 buttonStyle">
        <button class="storeButton4">Store Link</button>
        <a target="_blank" id="storedLinkButton4" class="spanA storedLinkButton">No Link Stored</a>
    </div>
    <br>
    <!--Maths-->
    <div>
        <label style="margin-left: 45px; margin-right: 45px;" for="linkInput5"><b>Maths: </b></label>
        <input style="cursor: text;" type="text" id="linkInput5" class="linkInput5 buttonStyle">
        <button class="storeButton5">Store Link</button>
        <a target="_blank" id="storedLinkButton5" class="spanA storedLinkButton">No Link Stored</a>
    </div>
    <br>
    <!--Health and PE-->
    <div>
        <label style="margin-left: 16px; margin-right: 16px;" for="linkInput6"><b>Health and PE: </b></label>
        <input style="cursor: text;" type="text" id="linkInput6" class="linkInput6 buttonStyle">
        <button class="storeButton6">Store Link</button>
        <a target="_blank" id="storedLinkButton6" class="spanA storedLinkButton">No Link Stored</a>
    </div>

    <button id="resetButton">Reset All Links</button>

    <script src="../Private/JS/Functions.js">
    </script>
    <?php include "Includes/footer.php"; ?>
  </body>
</html>