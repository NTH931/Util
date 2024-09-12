<?php
require_once '../../Private/PHP/variables.php';
require_once './css-functions.php';
require_once './media-queries.css.php';

header("Content-Type: text/css");

echo <<<CSS

/*-----------------------------------Tag Attribute Variables-------------------------------------*/
* {
  color: var(--text-color);
  color: inherit;
  font-family: Arial, Helvetica, sans-serif !important;
  margin: 0;
  padding: 0;
}

html { color: $textColor }

body {
  overflow: hidden;
  display: block;
  background-repeat: no-repeat;
  background-size: 100%, 100%;
  background-color: $backgroundColor;
}

textarea {
  border: 1px solid black;
  width: 225vh;
  height: 98vh;
  margin: 0;
  box-sizing: border-box;
  font-size: 1.1em;
}

textarea:focus {
  border: 1px solid black;
  outline: none;
}


a {
  text-decoration: none;
  font-size: 16px;
  color: $highlightColor;
  width: fit-content;
}

h1 {
  color: $textColor;
  display: inline-block;
  line-height: 10px;
  cursor: default;
}

h2, h3, h4, h5, h6, text {
  color: $textColor;
  padding: 10px;
  font-family: Arial, Helvetica, sans-serif;
  display: block;
}

nav {
  border-bottom: 2px solid $highlightColor;
  margin-left: -8px;
  margin-right: -8px;
  text-indent: 5px;
  height: fit-content;
  padding-bottom: 10px;
}

nav > button:nth-child(1) { margin-left: 10px }

aside {
  float: left;
  width: 50%;
  padding-left: 5px;
  text-align: left;
}

section {
  float: right;
  left: 50%;
  position: absolute;
  padding-bottom: 100px;
}

label { background-color: $buttonBg }

div { color: $textColor }

ul {
  margin-top: 15px;
  margin-bottom: 15px;
}

dropdown {
  display: inline-block; /* Prevents it from stretching to the full width */
  position: relative; /* For positioning dropdown elements */
  overflow-y: auto;
  max-height: 40vh !important;
  width: 100%
}

footer > h6 {
  position: absolute;
  border-top: 2px solid $highlightColor;
  left: -150px;
  width: 120%;
  bottom: 0;
  color: $textColor;
  background-color: $backgroundColor;
  padding-top: 0.5rem;
  padding-left: 0.5rem;
  text-align: center;
}

.addSave {
  font-size: 1rem;
  color: $highlightColor;
  width: fit-content;
  height: fit-content;
  padding: 0 5px 3px 5px;
  margin-top: 10px;
  margin-left: 10px;
  border-radius: 10px;
  border: 2px solid $highlightColor;
  background-color: transparent;
  transition: background-color 0.3s ease;
}

.addSave > b {
  position: relative;
  font-size: 1.3rem;
  top: 1px;
}

.addSave:hover {
  transition: none;
  background-color: $buttonBg;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

h4#todo {
  padding-top: 18px;
}

span#dropdown-label {
  user-select: none;
  position: sticky; /* Use sticky positioning to keep it in view */
  top: 0; /* Stick to the top of the container */
  border-radius: 0px;
  margin: 0;
  margin-top: 10px;
  margin-bottom: 10px;
  padding: 10px 40% 10px 40%;
  overflow-y: auto;
  font-size: 1.05rem
}

span#dropdown-label:hover {
  cursor: pointer;
  text-decoration: underline;
  background-color: darken($buttonBg, 5)
}

button,
select, 
option,
button:not(.no),  
input[type=text], 
input[type=submit],
input[type=button], 
input[type=search], 
.button {
  margin: 2px;
  margin-top: 1px;
  color: $highlightColor;
  font-size: 16px;
  padding: 3px 4px 2px 4px;
  border-radius: 20px;
  cursor: pointer;
  border: 1px solid $buttonBgLL;
  background-color: $buttonBg;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease !important;
  z-index: 10
}

button:hover, 
select:hover, 
option:hover,
input[type=button]:hover, 
input[type=submit]:hover {
  background-color: $buttonBgLL;
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

button:focus, 
select:focus, 
option:focus, 
input[type=button]:focus, 
input[type=submit]:focus, 
.button:focus, {
  outline: none;
}

/*------------------------------------------Class Selectors--------------------------------------------------*/

.valid { background-color: $darkGreen !important }

.invalid { background-color: $darkRed !important }

button.no {
  cursor: not-allowed;
  color: $redText;
}

button.no:hover { background-color: $buttonBgL }

input[type=text], input[type=search] {
  cursor: text;
  padding: 6px 5px 5px 5px;
  transition: translate 0.2s ease;
}

input[type=text]:hover, input[type=button]:hover { background-color: $buttonBg }

button.plus {
  height: 25px;
  width: 25px;
  margin-top: -10px;
  border-radius: 7.5px;
  color: $textColor;
  background-color: rgba(255, 255, 255, 0);
  border: 2px solid $textColor;
  box-shadow: 4px 6px 10px 0 rgba(0, 0, 0, 0.5) 0 17px 50px 0 rgba(0, 0, 0, 0.5);
  transform: none;
}
  
button.plus:hover {
  background-color: $buttonBg;
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}

button.plus:focus {
  outline: none;
  box-shadow: 0 0 0 3px $buttonBg;
}

.title {
  color: $textColor;
  display: inline-block;
  line-height: 10px;
  font-size: 1rem !important;
}

.main {
  width: 100%;
  text-align: left;
  align-self: auto;
}

.popout {
  position: relative;
  cursor: pointer !important;
  opacity: 0;
  left: 100%;
  margin-left: -5px;
  padding: 0 5px 1px 10px !important;
  font-size: 0.95rem;
  border-radius: 0 5px 5px 0 !important;
  z-index: 2;
  transform: translateX(-30px);
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.whitebg, span {
  display: block;
  height: fit-content;
  width: calc(fit-content + 50px);
  margin-top: -5px;
  border: 2px;
  text-align: center;
  border-radius: 7px;
  background-color: $buttonBg;
  text-decoration: none;
  padding-left: 5px;
  padding-right: 5px;
  z-index: 10;
}

.spanA {
  height: calc(fit-content + 20px);
  margin-top: -5px;
  border: 2px;
  text-align: center;
  border-radius: 7.5px;
  background-color: $buttonBg;
  text-decoration: none;
  padding-left: 5px;
  padding-right: 5px;
}

.hrcolor {
  border-bottom: 2px solid $highlightColor;
  padding-bottom: 8px;
  width: 99vw;
}

.hidden { display: none }

.notifi > .notifi-content {
  background-color: $backgroundColorL;
  padding: 100px;
  padding: 8px 7px 7px 7px;
  border: 1px solid #888;
  width: 80%;
}
.notifi > .notifi-content > .notifi-header {
  color: $highlightColor;
  font-size: 0.8rem;
  font-weight: bold;
  margin-bottom: 10px;
}
.notifi > .notifi-content > .notifi-message {
  color: $textColor;
  padding: 0 0 5px 7px;
}
.notifi > .notifi-content > .dismis {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
  transition: color 0.4s ease;
}

.notifi > .notifi-content > .dismis:hover { color: #fff }

.notifi .notifi-buttons {
  display: flex;
  justify-content: space-between;
}
.notifi .notifi-buttons > .notifi-button {
  color: #aaa;
  padding: 10px;
  border: 1px solid #888;
  border-radius: 6px;
  font-weight: normal;
  cursor: pointer;
  transition: color 0.4s ease;
  flex: 1;
  margin: 0 7px;
  max-height: 40px;
}

.notifi .notifi-buttons > .notifi-button:hover { color: #fff; }

.notifi .notifi-buttons > .notifi-button:focus {
  color: white;
  border: 1px solid $highlightColor;
}

.popout-parent {
  display: flex;
  flex-direction: column;
  z-index: 5;
}

.popout-wrapper { position: relative }

.container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-direction: row;
  padding: 10px;
}

h3.periods {
  text-decoration: underline;
  color: $highlightColor
}

ul.periods li {
  text-indent: 1rem;
  margin-bottom: 0.5rem;
}

ul.periods li { color: $backgroundColorLLL; text-decoration: underline }

/*----------------------------------------Id Selectors-------------------------------------------------------*/

#clock {
  font-size: 26px;
  font-weight: bold;
  color: var(--text-color);
  text-align: right;
  margin-left: 20px;
}

#title {
  margin-left: 0;
  margin-top: 5px;
  margin-bottom: 0;
  color: white;
  display: inline-block;
  line-height: 25px;
  width: 50%;
  font-size: 2.5rem !important;
  cursor: default;
}

#title:hover { cursor: pointer; }

#tabs { width: fit-content; }

#container {
  display: flex !important;
  flex-direction: row !important;
  flex-wrap: wrap;
}

#settings {
  display: none;
  padding: 10px;
  border-radius: 10px;
  background-color: $backgroundColorL;
  position: fixed; /* Change to fixed to keep it in a fixed position */
  width: 340px;
  height: max-content;
  left: 37vw;
  top: 20vh; /* Adjust top position */
  right: 10px; /* Move to the right edge of the viewport */
  z-index: 1000; /* Ensure it is above other content */
}

#submit:hover { cursor: pointer }

#fileInput { transition: background-color 0.2s ease }

#fileInput:hover { background-color: $buttonBgL }

CSS;