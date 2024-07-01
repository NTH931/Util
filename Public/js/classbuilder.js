import { Cookie, protoMethod } from "./utilities.js";

$(document).ready(function() {
  // Function to create and add pop-out elements from structured data
  function addPopoutElements(parentDivId, jsonObject) {
    const $parentDiv = $("#" + parentDivId);
  
    $parentDiv.css({
      display: "flex",
      flexDirection: "row",
      flexWrap: "wrap",
      alignItems: "center",
      margin: "0",
      padding: "0",
      maxHeight: "calc(1rem + 15px)",
      width: "fit-content"
    });
  
    try {
      // Iterate over jsonObject to create buttons
      $.each(jsonObject, function(index, button) {
        let realText = button.text.toLowerCase();

        //if (realText === "button 1" || realText === "button 2" || realText === "button 3") { return; }

        const $wrapper = $('<div>', { class: 'popout-wrapper' });
        const $buttonElement = $('<a>', {
          class:   'popout whitebg',
          id:      `button${index}`,
          text:     button.text
        });
        $buttonElement.click(function() { window.open(button.location, '_blank') || "#"; });
        $parentDiv.hover(
          async function() {
            setTimeout(function() {
              $buttonElement.css({
                left: "30px",
                visibility: "visible",
                opacity: 1,
                transition: "opacity 0.3s ease visibility 0.3s ease"
              });
            }, 100);
          },
          async function() {
            setTimeout(function() {
              $buttonElement.css({
                left: "calc(initial + 30px)",
                visibility: "hidden",
                opacity: 0,
                transition: "opacity 0.3s ease visibility 0.3s ease"
              });
            }, 100);
          }
        );
      
        // Append button to wrapper and wrapper to parentDiv
        $wrapper.append($buttonElement);
        $parentDiv.children('h4').first().after($wrapper);
      });
    } catch (error) {
      console.error(error);
    }
  }
  

  //// PROTOTYPE ////
  protoMethod(Object, 'swap', function() {
    const swapped = {};
    for (let key in this) {
      if (this.hasOwnProperty(key)) {
        swapped[this[key]] = key;
      }
    }
    return swapped;
  });
  
  //// PROTOTYPE ////
  protoMethod(Array, 'swap', function() {
    return this.map(obj => {
      const swapped = {};
      for (let key in obj) {
        if (obj.hasOwnProperty(key)) {
          swapped[obj[key]] = key;
        }
      }
      return swapped;
    });
  });

  // Function to fetch JSON data
  async function fetchData(url) {
    console.log(`Fetching data from ${url}`);
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const data = await response.json();
      return data;
    } catch (error) {
      console.error("Error fetching data:", error);
      return undefined || null;
    }
  }
  
  fetchData("../Private/JSON/lists.json")
  .then((data) => {
    for (let i = 1; i <= 9; i++) {
      const jsonItems = JSON.parse(Cookie.get(`class${i}`)) ?? undefined;
        
      try {
        const divElement = document.createElement('div');
        const aElement = document.createElement('a');
        const h4Element = document.createElement("h4");
          
        // Attributes
        aElement.id = `classbutton${i}`;
        aElement.classList.add('whitebg');
        aElement.setAttribute("target", "_blank");
        aElement.href = jsonItems.link;
        aElement.textContent = jsonItems.subject;
        divElement.id = `class${i}`;
        h4Element.classList.add('popout-parent');

        divElement.appendChild(h4Element);
        h4Element.appendChild(aElement);
        document.querySelector('aside').appendChild(divElement);

        // Adding pop-out elements
        addPopoutElements(`class${i}`, data[jsonItems.code]);
      } catch {
        console.warn(`No class is defined for iteration ${i}.`);
      }
    }
  })
  .catch(error => alert(error));
});