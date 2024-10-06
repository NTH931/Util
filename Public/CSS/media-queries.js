function get(name) {
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(name + '=')) 
      return decodeURIComponent(cookie.substring(name.length + 1));
    }
  return null;
}

const parseCookie = get("settings");

const RGB = {
  Red: "RED",
  Green: "GREEN",
  Blue: "BLUE"
};

let settings;
if (parseCookie) settings = JSON.parse(parseCookie);
else throw new Error("Cookie was null");

const baseTheme = settings["BaseColor"] ?? "blue";
const darkMode = settings["DarkMode"] ?? true;
const hexRegExp = /#[a-f0-9]{6}/i;

// Define theme-related variables
let theme;
let conflict;
let baseColor;

switch (baseTheme) {
  case "red":
  case "orange":
    theme = RGB.Red;
    conflict = RGB.Green;
    baseColor = "#ff7700";
    break;
  case "yellow":
    theme = RGB.Red;
    conflict = RGB.Green;
    baseColor = "#ffaa00";
    break;
  case "green":
    theme = RGB.Green;
    conflict = RGB.Blue;
    baseColor = "#77ff77";
    break;
  case "blue":
    theme = RGB.Blue;
    conflict = RGB.Green;
    baseColor = "#0077ff";
    break;
  case "purple":
    theme = RGB.Blue;
    conflict = RGB.Red;
    baseColor = "#ab00ff";
    break;
  default:
    theme = RGB.Blue;
    conflict = RGB.Green;
    baseColor = "#0077ff";
    break;
}

// Function to modify color strength (enhance/darken)
function modifyColorStrength(color, baseColor, enhancement = 100) {
  baseColor = baseColor.startsWith('#') ? baseColor.slice(1) : baseColor;

  // Ensure valid hex length
  if (baseColor.length !== 6) {
    console.error("Invalid baseColor length: ", baseColor);
    return '#000000'; // Return black as a fallback
  }

  const rBase = parseInt(baseColor.slice(0, 2), 16);
  const gBase = parseInt(baseColor.slice(2, 4), 16);
  const bBase = parseInt(baseColor.slice(4, 6), 16);

  let rEnhanced = rBase, gEnhanced = gBase, bEnhanced = bBase;

  switch (color) {
    case "RED":
      rEnhanced = Math.min(255, rBase + enhancement);
      break;
    case "GREEN":
      gEnhanced = Math.min(255, gBase + enhancement);
      break;
    case "BLUE":
      bEnhanced = Math.min(255, bBase + enhancement);
      break;
  }

  // Ensure enhanced values are within 0-255 range
  if (isNaN(rEnhanced) || isNaN(gEnhanced) || isNaN(bEnhanced)) {
    console.error("NaN encountered in color enhancement", { rEnhanced, gEnhanced, bEnhanced });
    return '#000000'; // Return black as fallback
  }

  // Ensure padding is applied to each hex component
  return `#${rEnhanced.toString(16).padStart(2, '0')}${gEnhanced.toString(16).padStart(2, '0')}${bEnhanced.toString(16).padStart(2, '0')}`;
}

// Function to adjust brightness of a color
function adjustBrightness(hex, percent) {
  hex = hex.startsWith('#') ? hex.slice(1) : hex;

  // Ensure valid hex length
  if (hex.length !== 6) {
    console.error("Invalid hex length: ", hex);
    return '#000000'; // Return black as fallback
  }

  let r = parseInt(hex.slice(0, 2), 16);
  let g = parseInt(hex.slice(2, 4), 16);
  let b = parseInt(hex.slice(4, 6), 16);

  // Adjust brightness and clamp values between 0 and 255
  r = Math.min(255, Math.max(0, r + Math.round(r * percent / 100)));
  g = Math.min(255, Math.max(0, g + Math.round(g * percent / 100)));
  b = Math.min(255, Math.max(0, b + Math.round(b * percent / 100)));

  if (isNaN(r) || isNaN(g) || isNaN(b)) {
    console.error("NaN encountered in brightness adjustment", { r, g, b });
    return '#000000'; // Return black as fallback
  }

  // Ensure hex values are correctly padded
  return `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
}

// Function to filter color based on RGB components
function filterColor(color, hex) {
  if (hex.startsWith('#')) {
    hex = hex.slice(1);
  } else {
    return "Invalid color or hex format.";
  }

  // Ensure valid hex length
  if (hex.length !== 6) {
    console.error("Invalid hex length in filterColor: ", hex);
    return '#000000'; // Return black as fallback
  }

  let r = 0, g = 0, b = 0;

  if (Array.isArray(color)) {
    r = color.includes("RED") ? parseInt(hex.slice(0, 2), 16) : 0;
    g = color.includes("GREEN") ? parseInt(hex.slice(2, 4), 16) : 0;
    b = color.includes("BLUE") ? parseInt(hex.slice(4, 6), 16) : 0;
  } else {
    r = (color === "RED" || color === "GREY") ? parseInt(hex.slice(0, 2), 16) : 0;
    g = (color === "GREEN" || color === "GREY") ? parseInt(hex.slice(2, 4), 16) : 0;
    b = (color === "BLUE" || color === "GREY") ? parseInt(hex.slice(4, 6), 16) : 0;

    if (color === "GREY") {
      const grey = Math.round((r + g + b) / 3);
      return `#${grey.toString(16).padStart(2, '0').repeat(3)}`;
    }
  }

  if (isNaN(r) || isNaN(g) || isNaN(b)) {
    console.error("NaN encountered in filterColor", { r, g, b });
    return '#000000'; // Return black as fallback
  }

  // Return properly padded hex values
  return `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
}

// Function to apply greyscale to a color
function greyscale(hex) {
  // Check if the hex starts with '#' and has a length of 7
  if (hex.startsWith('#') && hex.length === 7) {
      const r = parseInt(hex.slice(1, 3), 16);
      const g = parseInt(hex.slice(3, 5), 16);
      const b = parseInt(hex.slice(5, 7), 16);

      // Calculate the average to get grey
      const grey = Math.round((r + g + b) / 3);
      return `#${grey.toString(16).padStart(2, '0').repeat(3)}`;
  }

  console.error("Invalid hex format: ", hex);
  return '#000000'; // Return black as a fallback for invalid input
}

// Darken and lighten functions
function darken(hex, percent) { return adjustBrightness(hex, -percent); }
function lighten(hex, percent) { return adjustBrightness(hex, percent); }

// Enhance and de-enhance functions
function enhance(color, baseColor, enhancement = 100) {
  return modifyColorStrength(color, baseColor, enhancement);
}


// Apply light or dark mode styles
let buttonBg, buttonBgL, buttonBgLL, buttonBgLLL, backgroundColor, backgroundColorL, backgroundColorLL, backgroundColorLLL, highlightColor;
if (!darkMode) {
  console.log("Dark Mode");
  // Light mode
  buttonBg = darken(filterColor([theme, conflict], baseColor), 75);
  buttonBgL = filterColor([theme, conflict], darken(baseColor, 70));
  buttonBgLL = filterColor([theme, conflict], darken(baseColor, 65));
  buttonBgLLL = filterColor([theme, conflict], darken(baseColor, 62));
  backgroundColor = darken(baseColor, 55);
  backgroundColorL = filterColor([theme, conflict], darken(baseColor, 60));
  backgroundColorLL = filterColor([theme, conflict], darken(baseColor, 35));
  backgroundColorLLL = filterColor([theme, conflict], darken(baseColor, 30));
  highlightColor = lighten(baseColor, 100);
} else {
  console.log("Light Mode");
  // Dark mode
  buttonBg = filterColor([theme, conflict], darken(baseColor, 85));
  buttonBgL = filterColor([theme, conflict], darken(baseColor, 80));
  buttonBgLL = filterColor([theme, conflict], darken(baseColor, 75));
  buttonBgLLL = filterColor([theme, conflict], darken(baseColor, 70));
  backgroundColor = darken(baseColor, 99);
  backgroundColorL = darken(baseColor, 95);
  backgroundColorLL = filterColor([theme, conflict], darken(baseColor, 80));
  backgroundColorLLL = filterColor([theme, conflict], darken(baseColor, 55));
  highlightColor = baseColor;
}

// Dynamically inject CSS styles into the document

document.addEventListener("DOMContentLoaded", () => {
  Object.entries({
    "--button-bg": buttonBg,
    "--button-bg-l": buttonBgL,
    "--button-bg-ll": buttonBgLL,
    "--button-bg-lll": buttonBgLLL,
    "--text-color": "#dddddd", /* color of text */
    "--background-color": backgroundColor, /* color of background */
    "--background-color-l": backgroundColorL, /* color of light background */
    "--background-color-ll": backgroundColorLL,
    "--background-color-lll": backgroundColorLLL,
    "--highlight-color": highlightColor, /* color of dividers */
    "--red-text": lighten(enhance(theme, baseColor, 225), 15),
    "--green": filterColor(["GREEN", theme], darken(baseColor, 20)),
    "--dark-green": darken(enhance("GREEN", filterColor(["GREEN", theme], darken(baseColor, 100))), 80),
    "--dark-red": filterColor("RED", enhance("RED", baseColor, 60))
  }).forEach(([key, value]) => {
    if (!key || !value) {
      throw new Error(key ? "value is not defined" : "key is not defined");
    } else if (typeof key !== 'string') {
      throw new TypeError("key is not a string, as expected. Key is " + (typeof key).toString());
    } else if (!hexRegExp.test(value)) {
      throw new TypeError(`value of ${key} does not conform to RegExp /#[a-f0-9]{6}/i. value was ${value.toString()}`);
    } else {
      document.body.style.setProperty(key, value);
    }
  });
});