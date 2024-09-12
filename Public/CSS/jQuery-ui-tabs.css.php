<?php 
require_once '../../Private/PHP/variables.php';
require_once './css-functions.php';
require_once './media-queries.css.php';

header("Content-Type: text/css");

echo <<<CSS

/* Main container for the tabs UI */
.ui-tabs {
  display: flex;
  flex-direction: row-reverse;
  background-color: $backgroundColor; 
  color: $textColor;
  border: none !important;
  height: 77vh;
  border-left: 2px solid $highlightColor !important;
  border-radius: 0 !important;
  padding: 0;
  cursor: default;
  position: relative;
}

/* Container for the tab headers */
.ui-tabs .ui-tabs-nav {
  background-color: $backgroundColor;
  margin: 0;
  height: calc(98% + 4px);
  padding: 0;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  border: none;
  flex-shrink: 0;
  z-index: 1;
}

/* Styles for all individual tab's containers (li) and tab (a) */
.ui-tabs .ui-tabs-nav li, .ui-tabs .ui-tabs-nav a {
  display: flex;
  padding: 2px 3px !important;
  margin: 0;
  flex: 1;
  border: none;
  border-radius: 0;
  background-color: $backgroundColor; 
  cursor: pointer !important;
  writing-mode: vertical-rl;
  text-orientation: mixed;
  transform: rotate(180deg);
  text-align: center;
  justify-content: center;
  white-space: nowrap;
  transition-duration: 0.5s;
  transition-property: padding, background-color, border;
  transition-timing-function: ease;
}

/* Styles for the active tab */
.ui-tabs .ui-tabs-nav .ui-state-active a {
  background-color: $backgroundColorLL;
  color: $textColor; 
  border: 1px solid $textColor !important;
  padding: 1px 10px !important;
  text-align: center;
}

/* Styles for inactive tabs */
.ui-tabs .ui-tabs-nav :not(.ui-state-active) a {
  background-color: $backgroundColorL; /* Replaced var(--background-color-l) */
  color: $textColor;
  border: 1px solid $textColor !important;
}

/* Hover effect for inactive tabs */
.ui-tabs .ui-tabs-nav :not(.ui-state-active) a:hover {
  background-color: $backgroundColorLL; /* Replaced var(--background-color-ll) */
  padding: 1px 10px !important;
}

/* Container for the content of the active tab */
.ui-tabs .ui-tabs-panel {
  display: initial;
  height: 100%;
  width: calc(45vw + 2px);
  overflow-y: auto;
  background-color: inherit;
  border: none;
  padding: 0 10px;
  cursor: default !important;
  flex: 1;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.5s ease, visibility 0.5s ease;
}

/* Container for the content of the active tab when active */
.ui-tabs .ui-container-active {
  opacity: 1;
  visibility: visible;
  transition: opacity 0.5s ease, visibility 0.5s ease;
}

/* Extras */

#classes, #rooms {
  padding-top: 10px;
  color: $textColor
}

#classes > * > b, #rooms > * > b {
  margin-right: 20px;
  padding: 10px;
  cursor: default;
  font-family: "Courier New", Courier, monospace !important;
  border: 1px solid $highlightColor
}

#rooms > * > b + b {
  border-color: $backgroundColorLLL
}

#classes > *, #rooms > * {
  padding: 5px;
  margin-bottom: 10px;
}
CSS;