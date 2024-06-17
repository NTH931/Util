import * as util from "./utilities.js";

$(document).ready(function() {
//document.addEventListener("listener", (e) => { code } );
  document.addEventListener("contextmenu", (e) => e.preventDefault());

  document.querySelectorAll('h4 > a').forEach(h4 => {
    h4.addEventListener("mousedown", function(e) {
      //e.preventDefault();
      if (this.id !== "todo") {
        e.stopPropagation(); // Stop the event from bubbling up
        if (e.button === 2) {
          const classhref = this.getAttribute('classhref');
          e.preventDefault();
          if (classhref != null) {
              window.open(classhref, '_blank');
          } else {
              alert("No class has been specified for " + this.textContent);
          };
        };
      };
    });
  });
});

/*async function processICSFile(file) {
  try {
    const events = await util.parseICS(file);
    console.log(events); // Output the parsed events
  } catch (error) {
    console.error('Error parsing ICS file:', error);
  }
}

processICSFile("ics/aoteatimetable.ics");*/