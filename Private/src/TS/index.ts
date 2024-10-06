import * as utils from './utilities.js';
const { iNotification, redirect, reload, fetchData, cookie, Settings, Codes, $document } = utils;

$.fn.toHTMLElement = function (this: JQuery<HTMLElement>): HTMLElement | null {
  return this.get(0) ?? null;
};

class Links {
  private target: JQuery;
  private pend: "append" | "prepend";

  constructor(target: string, appendOrPrepend: "append" | "prepend") {
    this.target = $(target);
    this.pend = appendOrPrepend;
  }

  head(text: string): void {
    this.target[this.pend](`\n<h4>${text}</h4>\n`);
  }

  links(code: keyof typeof Codes | null, link: string, displayName: string, blank: boolean = true): void {
    if (code === null) {
      console.warn("Code is null. Defaulting to the class unmanagedCodes");
      this.target[this.pend](`<button class="unmanagedCodes" onclick="window.open('${link}', ${blank ? '_blank' : '_self'}')">${displayName}</button>\n`);
    } else if (Settings.Buttons[code] && Settings.Buttons[code] === true) {
      this.target[this.pend](`<button id="${code}" onclick="window.open('${link}', ${blank ? '_blank' : '_self'}')">${displayName}</button>\n`);
    } else if (Settings.Buttons[code] && Settings.Buttons[code] === false) {
      this.target[this.pend](`<button id="${code}"  class='no'>${displayName} - <b>Unavailable</b></button>\n`);
    } else {
      console.error(`Couldn't find Settings.Buttons.${code} Value found was ${Settings.Buttons[code]}`);
      this.target[this.pend]("\n");
    }
  }
}

//= JQuery UI Tabs
$(() => {
  $("#tabs").tabs({
    beforeActivate: (_, ui) => {
      ui.oldPanel.removeClass("ui-container-active");
    },
    activate: (_, ui) => {
      ui.newPanel.addClass("ui-container-active");
    }
  });
  $("#tabs .ui-tabs-panel").first().addClass("ui-container-active");
});

//= Creates 
$(() => {
  const $addClasses: JQuery<HTMLHeadingElement> = $("#addClasses");

  const settings = JSON.parse(cookie.get("settings") ?? "");
  // Function to create and add pop-out elements from structured data
  function addPopoutElements(parentDivId: string, jsonObject: Button[]) {
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
      $.each([...jsonObject].reverse(), (index, button) => {
        const buttonText = button["text"];
        if (buttonText.toLowerCase() === "button 1" || buttonText.toLowerCase() === "button 2" || buttonText.toLowerCase() === "button 3") return;

        const $wrapper = $(`<div>`, { class: 'popout-wrapper' });
        const $buttonElement = $(`<a>`, {
          class:   'popout whitebg',
          id:      `button${String(index)}`,
          text:     buttonText
        });

        // eslint-disable-next-line prefer-arrow-callback
        $buttonElement.css("background-color", function(this: HTMLElement): string {
          switch(index) {
            case 0:
              return "var(--button-bg-lll)";
            case 1:
              return "var(--button-bg-ll)";
            case 2:
              return "var(--button-bg-l)";
            default:
              return "var(--button-bg-l)";
          }
        });

        $buttonElement.css("z-index", index);

        $buttonElement.on('click', () => { window.open(button["location"], '_blank'); });
        $parentDiv.on({
          mouseenter: () => {
            setTimeout(() => {
              $buttonElement.css({
                left: "20px",
                visibility: "visible",
                opacity: 1,
                transition: `opacity 0.3s ease, visibility 0.3s ease`
              });
            }, 100);
          },
          mouseleave: () => {
            setTimeout(() => {
              $buttonElement.css({
                visibility: "hidden",
                opacity: 0,
                transition: `opacity 0.3s ease, visibility 0.3s ease`
              });
            }, 100);
          }
        });
      
        // Append button to wrapper and wrapper to parentDiv
        $wrapper.append($buttonElement);
        $parentDiv.children('h4').first().after($wrapper);
      });
    } catch (error) {
      console.error(error);
    }
  }
  
  fetchData("../Private/JSON/lists.json")
  .then((data) => {
    if (!data) return;

    for (let i = 1; i <= 8; i++) {
      const jsonString = localStorage.getItem(`class${i}`);
      const jsonItems: cookieString | null = jsonString ? JSON.parse(jsonString) : null;

      if (!jsonItems || typeof jsonItems !== 'object' || Array.isArray(jsonItems) || Object.keys(jsonItems).length === 0) {
        continue;
      }
        
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
        if ($addClasses) document.querySelector('aside')?.insertBefore(divElement, $addClasses.toHTMLElement());

        // Adding pop-out elements
        if (settings.Tooltips) addPopoutElements(`class${i}`, data[jsonItems.code]);
      } catch (error: any) {
        console.warn(error);
      }
    }

    // AddClasses
    if (document.querySelector("aside > div#class7")) {
      console.log(`AddClasses button Generated`);
      $addClasses.html("<b>~ </b>Edit Classes");
    } else {
      $addClasses.html("<b>+ </b>Add Classes");
    }
  })
  .catch(error => alert(error.message));
});

//= Button.on("click") popouts
$(() => {
  $(document).on("click", () => $(".side-element").fadeOut(400).remove());

  $("button").on("contextmenu", function(event) {
    event.stopPropagation();
    event.preventDefault();

    $(".side-element").fadeOut(400).remove();

    const button = $(this);
    const buttonOffset = button.offset();
    const buttonHeight = button.outerHeight();
    const buttonWidth = button.outerWidth();

    if (buttonOffset && buttonHeight && buttonWidth) {
      ['left', 'right'].forEach(position => {
        const $el = $("<div>", { class: "side-element" }).appendTo("body");
        $el
          .css({
            position: "absolute",
            zIndex: 10,
            width: "50px",
            height: "50px",
            backgroundColor: "lightblue",
            display: "none"
          })
          .addClass("button")
          .addClass("side-element");

        switch (position) {
          case 'left':
            $el.css({
              top: buttonOffset.top + (buttonHeight / 2) - ($el.outerHeight()! / 2),
              left: buttonOffset.left - $el.outerWidth()!
            }).show().animate({
              left: buttonOffset.left - $el.outerWidth()! - 10
            }, 400);
            $el.text("Info");
            break;
          case 'right':
            $el.css({
              top: buttonOffset.top + (buttonHeight / 2) - ($el.outerHeight()! / 2),
              left: buttonOffset.left + buttonWidth
            }).show().animate({
              left: buttonOffset.left + buttonWidth + 10
            }, 400);
            $el.text("Remove");
            break;
        }
      });
    }
  });
});

//= Links in Website Links tab
$(() => {
  const websiteLinks = new Links("#tab-1", "append");

  websiteLinks.head("Aotea");
  websiteLinks.links(Codes.ATC, "https://www.aotea.school.nz/", "Aotea College");
  websiteLinks.links(Codes.ATL, "https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library");
  websiteLinks.links(Codes.ATN, "https://soraapp.com/home", "New Library");
  //* websiteLinks.plus("addNewAotea");
  
  websiteLinks.head("Exam Sites");
  websiteLinks.links(Codes.NQA, "https://taku.nzqa.govt.nz/learner-home/", "NZQA");
  websiteLinks.links(Codes.NCR, "https://www.nzceronline.org.nz/", "NZCER Online");
  //* websiteLinks.plus("addNewExamSite");
  
  websiteLinks.head("Google Services");
  websiteLinks.links(Codes.GML, "https://mail.google.com", "Gmail");
  websiteLinks.links(Codes.DRV, "https://drive.google.com/", "Drive");
  websiteLinks.links(Codes.CLR, "https://classroom.google.com/", "Classroom");
  websiteLinks.links(Codes.DCS, "https://docs.google.com/document/", "Docs");
  websiteLinks.links(Codes.SLD, "https://docs.google.com/presentation/", "Slides");
  websiteLinks.links(Codes.SHT, "https://docs.google.com/spreadsheets/", "Sheets");
  websiteLinks.links(Codes.FRM, "https://docs.google.com/forms/", "Forms");
  websiteLinks.links(Codes.STS, "https://sites.google.com/", "Sites");
  //* websiteLinks.plus("addNewDrive");
  
  websiteLinks.head("Other");
  websiteLinks.links(Codes.KHT, "https://kahoot.it", "Kahoot!");
  websiteLinks.links(Codes.BLK, "https://dashboard.blooket.com/stats", "Blooket");
  websiteLinks.links(Codes.RMB, "https://remove.bg", "Remove.bg");
  websiteLinks.links(Codes.USC, "https://www.unscreen.com/", "Unscreen");
  websiteLinks.links(Codes.CVT, "https://convertio.co/", "Convertio");
  //* websiteLinks.plus("addNewOther");

  const navBar = new Links("#navBar", "prepend");

  navBar.links(null, "https://www.google.com/", "Google");
  navBar.links(null, "https://whanau.aotea.school.nz", "Whanau Portal");
});

//= Settings
$(() => {
  const $settings = $("#settings");
  $("#settingsshow").on("click", (event) => {
    event.stopPropagation(); // Prevent the click event from bubbling up to the document
    $settings.fadeToggle(400);
  });

  $("#exit").on("click", (event) => {
    event.stopPropagation(); // Prevent the click event from bubbling up to the document
    $settings.fadeOut(400);
  });

  document.bindShortcut("ctrl+shift+s", () => {
    $settings.fadeIn(400);
  });

  //= Dragging Capabilities
  $settings.on("mousedown", (e: JQuery.MouseDownEvent) => {
    // Calculate the shift in mouse position
    const shiftX = e.clientX - $settings[0].getBoundingClientRect().left;
    const shiftY = e.clientY - $settings[0].getBoundingClientRect().top;

    const moveAt = (pageX: number, pageY: number) => {
      $settings.css({
        left: `${pageX - shiftX}px`,
        top: `${pageY - shiftY}px`
      });
    };

    const onMouseMove = (e: MouseEvent) => { moveAt(e.pageX, e.pageY); };

    // Move the div on mousemove
    $document.on("mousemove", (e) => onMouseMove(e.originalEvent as MouseEvent));
    const onMouseUp = () => { $document.off("mousemove"); };
    $document.on("mouseup", onMouseUp);

    // Prevent default drag behavior
    e.preventDefault(); // Prevent text selection
  });
});

//= Maniging the form in settings.html and settings.html
utils.includeHTMLFile("./Includes/settings.html", $("div#settings"))
.then(async () => {
  
  for (const key of ["red", "yellow", "green", "blue", "purple", "default"]) {
    let option: HTMLOptionElement | HTMLSelectElement = document.getElementById("BaseColor") as HTMLSelectElement;
    if (option) {
      option = option.querySelector(`option[value=${key === "default" ? "blue" : key}]`) as HTMLOptionElement;
    } else throw new Error(`Couldn't find option[value=${key === "default" ? "blue" : key}]`);

    if (option.value === (Settings.BaseColor === "default" ? "blue" : Settings.BaseColor)) {
      console.log("Setting matched,", Settings.BaseColor);
      option.selected = true;
      break;
    }
  }

  for (const key of [1, 2, 3]) {
    let option: HTMLOptionElement | HTMLSelectElement = document.getElementById("Notifications") as HTMLSelectElement;

    if (option) {
      option = option.querySelector(`option[value="${key}"]`) as HTMLOptionElement;
    } else throw new Error(`Couldn't find option[value="${key}"]`);

    console.log(Settings.Notifications, option.value);

    if (option.value === Settings.Notifications?.toString()) {
      console.log("Setting matched,", Settings.Notifications);
      option.selected = true;
      break;
    }
    if (key === 3) {
      throw new Error("No Matches");
    }
  }

  Object.entries(Settings).forEach(([key, value]) => {
    if (typeof value === 'boolean' && value) {
      console.log($(`#${key}`).attr("checked", "checked"));
      $(`#${key}`).attr("checked", value.toString());
    } 
  });

  // Dropdown
  const file: { ButtonsObj: Record<string, string> } = await fetchData("../Private/JSON/objects.json");
  if (file.ButtonsObj) {
    for (const [key, value] of Object.entries(file.ButtonsObj)) {

      const modifiers = value.split("!");
      if (modifiers[1] === "unavaliable") continue;

      let checked: boolean = false;
      if (Settings.Buttons[key]) {
        checked = true;
      }

      const encodedValue = modifiers[0];

      
      $("#ButtonsDrop").append(`
        <label class="switch">
          ${encodedValue}:
          <input type="checkbox" id="${key}" name="Buttons[${key}]" value="1" ${checked ? "checked" : ""}>
          <span class="slider"></span>
        </label><br>
      `);
    }
  }

  const thisForm = document.forms.namedItem("settings-form");
  thisForm?.addEventListener("submit", e => {
    e.preventDefault();
    const formData = new FormData(thisForm);

    if (!Settings) {
      cookie.set("settings", utils.SettingsDefault, 365 * 5);
      reload();
    }
    
    const buttons: Record<string, boolean> = {};
    formData.forEach((value, key) => {
      if (key.startsWith("Buttons[")) {
        const buttonName = key.match(/Buttons\[(.*)\]/)?.[1]; // Extract the button name
        if (buttonName) {
          buttons[buttonName] = value === "1"; // Convert to boolean
        }
      }
    });

    cookie.set("settings", {
      BaseColor: formData.get("BaseColor") as string,
      Notifications: parseInt(formData.get("Notifications") as string),
      DarkMode: formData.get("DarkMode") === "1",
      Tooltips: formData.get("Tooltips") === "1",
      Buttons: buttons
    } satisfies Settings, 365 * 5);
    reload();
  });
});

//= Cookies
$(() => {
  if (!cookie.get("page_visited")) {
    cookie.set("page_visited", true, 365 * 5);
    cookie.set("settings", utils.SettingsDefault, 365 * 5);
    location.reload();
  }
  
  if (!cookie.get("clicked")) {
    iNotification({
      header: "Welcome to Util!",
      message:
      "Click the Go To Settings button to change the sites settings.<br>" +
      "Click the Change Classes button to change your classes."
      ,
    }, [
      {buttonText: "Go To Settings", buttonFunction: () => $("//settings").show()},
      {buttonText: "Cutomize Classes", buttonFunction: () => redirect("links.html")},
      {buttonText: "Stop Showing", buttonFunction: () => cookie.set("clicked", true)}
    ], true, {width: "700px", position: {right: "20vw", top: "40vh"}});
  }
});