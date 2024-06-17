document.addEventListener("DOMContentLoaded", function() {
  // Function to create and add pop-out elements from structured data
  function addPopoutElements(parentDiv, elements, type = "button") {
    elements.forEach(element => {
      const wrapper = document.createElement('div');
      const buttonElement = document.createElement(type);

      wrapper.classList.add('popout-wrapper');
      buttonElement.style.visibility = "hidden"
      buttonElement.textContent = element.text;
      buttonElement.setAttribute('onclick', `window.location.href='${element.location}'`);

      wrapper.appendChild(buttonElement);
      parentDiv.appendChild(wrapper);
      
      $(wrapper).hover(
        function () {
          $(this).find(parentDiv).css("visibility", "visible");
        },
        function () {
          $(this).find(parentDiv).css("visibility", "hidden");
        }
      );
    });
  }

  // Function to fetch JSON data
  async function fetchData(url) {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return await response.json();
  }

  // Loop through localStorage to retrieve and add elements
  for (let i = 1; i < 9; i++) {
    const classHref = JSON.parse(localStorage.getItem(`class${i}`));
    if (classHref) {
      const h4Element = document.createElement('h4');
      const aElement = document.createElement('a');

      console.log(`Elements <h4>, <a>, <div> Created for ${classHref.subject}.`);

      aElement.id = `classbutton${i}`;
      aElement.classList.add('whitebg');
      aElement.setAttribute("target", "_blank"); // Assuming all links open in new tab
      aElement.href = classHref.link;
      aElement.textContent = classHref.subject;

      h4Element.appendChild(aElement);
      document.querySelector('aside').appendChild(h4Element);

      // Adding pop-out elements
      fetchData("../Private/JSON/lists.json").then(data => {
        console.log('Available keys in JSON:', Object.keys(data));
        console.log('ClassHref Subject:', classHref.subject);

        const classData = data[classHref.subject];
        if (!classData) {
          console.error(`No data found for ${classHref.subject}`);
          return;
        }

        addPopoutElements(h4Element, classData, "a");
      }).catch(error => {
        console.error("Error fetching data:", error);
      });
    }
  }
});
