// Document Loaded
document.addEventListener("DOMContentLoaded", async function() {
  try {
    // Load the font using the FontFace API
    const font = new FontFace('Roboto', 'url(https://fonts.gstatic.com/s/roboto/v29/KFOmCnqEu92Fr1Me5Q.ttf)');

    // Wait for the font to be loaded
    await font.load();

    // Add the font to the document
    document.fonts.add(font);

    // Apply the font-family to the html element
    $("html").css({
      "font-family": "'Roboto', 'sans-serif'"
    });
  } catch (error) {
    console.error("Error loading the font:", error);
  }
});

document.querySelectorAll('h4 > a').forEach(h4 => {
  h4.addEventListener("mousedown", function(e) {
    e.preventDefault();
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
    } else {
      return null;
    }
  });
});