import * as util from "./utilities.js";

$(document).ready(function() {
  document.addEventListener("contextmenu", (e) => e.preventDefault());
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