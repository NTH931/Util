import * as utils from './utilities.js';
const { iNotification, redirect, reload, fetchData, cookie, Settings, Codes, $document } = utils;
$.fn.toHTMLElement = function () {
    return this.get(0) ?? null;
};
class Links {
    target;
    pend;
    constructor(target, appendOrPrepend = "append") {
        this.target = $(target);
        this.pend = appendOrPrepend;
    }
    head(text) {
        this.target[this.pend](`\n<h4>${text}</h4>\n`);
    }
    links(code, link, displayName, blank = true) {
        if (Settings.Buttons[code] && Settings.Buttons[code] === true) {
            this.target[this.pend](`<button id="${code}">${displayName}</button>\n`);
        }
        else if (Settings.Buttons[code] && Settings.Buttons[code] === false) {
            this.target[this.pend](`<button id="${code}" class='no'>${displayName} - <b>Unavailable</b></button>\n`);
        }
        else {
            console.error(`Couldn't find Settings.Buttons.${code} Value found was ${Settings.Buttons[code]}`);
            this.target[this.pend]("\n");
        }
        if (code !== null)
            this.addEventListener(code, link, blank);
    }
    addEventListener(element, location, blank) {
        this.target.on('click', `#${element}`, () => window.open(location, blank ? '_blank' : '_self'));
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
    const $addClasses = $("#addClasses");
    $addClasses.on("click", () => redirect("links.html"));
    const settings = JSON.parse(cookie.get("settings") ?? "");
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
            $.each([...jsonObject].reverse(), (index, button) => {
                const buttonText = button["text"];
                if (buttonText.toLowerCase() === "button 1" || buttonText.toLowerCase() === "button 2" || buttonText.toLowerCase() === "button 3")
                    return;
                const $wrapper = $(`<div>`, { class: 'popout-wrapper' });
                const $buttonElement = $(`<a>`, {
                    class: 'popout whitebg',
                    id: `button${String(index)}`,
                    text: buttonText
                });
                // eslint-disable-next-line prefer-arrow-callback
                $buttonElement.css("background-color", function () {
                    switch (index) {
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
        }
        catch (error) {
            console.error(error);
        }
    }
    fetchData("./JSON/lists.json")
        .then((data) => {
        if (!data)
            return;
        for (let i = 1; i <= 8; i++) {
            const jsonString = localStorage.getItem(`class${i}`);
            const jsonItems = jsonString ? JSON.parse(jsonString) : null;
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
                if ($addClasses)
                    document.querySelector('aside')?.insertBefore(divElement, $addClasses.toHTMLElement());
                // Adding pop-out elements
                if (settings.Tooltips)
                    addPopoutElements(`class${i}`, data[jsonItems.code]);
            }
            catch (error) {
                console.warn(error);
            }
        }
        // AddClasses
        if (document.querySelector("aside > div#class7")) {
            console.log(`AddClasses button Generated`);
            $addClasses.html("<b>~ </b>Edit Classes");
        }
        else {
            $addClasses.html("<b>+ </b>Add Classes");
        }
    })
        .catch(error => alert(error.message));
});
//= Button.on("click") popouts
$(() => {
    $(document).on("click", () => $(".side-element").fadeOut(400).remove());
    $("button").on("contextmenu", function (event) {
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
                            top: buttonOffset.top + (buttonHeight / 2) - ($el.outerHeight() / 2),
                            left: buttonOffset.left - $el.outerWidth()
                        }).show().animate({
                            left: buttonOffset.left - $el.outerWidth() - 10
                        }, 400);
                        $el.text("Info");
                        break;
                    case 'right':
                        $el.css({
                            top: buttonOffset.top + (buttonHeight / 2) - ($el.outerHeight() / 2),
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
    const websiteLinks = new Links("#tab-1");
    websiteLinks.head("Aotea");
    websiteLinks.links("ATC" /* Codes.ATC */, "https://www.aotea.school.nz/", "Aotea College");
    websiteLinks.links("ATL" /* Codes.ATL */, "https://nz.accessit.online/ATC00/#!dashboard", "Aotea Library");
    websiteLinks.links("ATN" /* Codes.ATN */, "https://soraapp.com/home", "New Library");
    //* websiteLinks.plus("addNewAotea");
    websiteLinks.head("Exam Sites");
    websiteLinks.links("NQA" /* Codes.NQA */, "https://taku.nzqa.govt.nz/learner-home/", "NZQA");
    websiteLinks.links("NCR" /* Codes.NCR */, "https://www.nzceronline.org.nz/", "NZCER Online");
    //* websiteLinks.plus("addNewExamSite");
    websiteLinks.head("Google Services");
    websiteLinks.links("GML" /* Codes.GML */, "https://mail.google.com", "Gmail");
    websiteLinks.links("DRV" /* Codes.DRV */, "https://drive.google.com/", "Drive");
    websiteLinks.links("CLR" /* Codes.CLR */, "https://classroom.google.com/", "Classroom");
    websiteLinks.links("DCS" /* Codes.DCS */, "https://docs.google.com/document/", "Docs");
    websiteLinks.links("SLD" /* Codes.SLD */, "https://docs.google.com/presentation/", "Slides");
    websiteLinks.links("SHT" /* Codes.SHT */, "https://docs.google.com/spreadsheets/", "Sheets");
    websiteLinks.links("FRM" /* Codes.FRM */, "https://docs.google.com/forms/", "Forms");
    websiteLinks.links("STS" /* Codes.STS */, "https://sites.google.com/", "Sites");
    //* websiteLinks.plus("addNewDrive");
    websiteLinks.head("Other");
    websiteLinks.links("KHT" /* Codes.KHT */, "https://kahoot.it", "Kahoot!");
    websiteLinks.links("BLK" /* Codes.BLK */, "https://dashboard.blooket.com/stats", "Blooket");
    websiteLinks.links("RMB" /* Codes.RMB */, "https://remove.bg", "Remove.bg");
    websiteLinks.links("USC" /* Codes.USC */, "https://www.unscreen.com/", "Unscreen");
    websiteLinks.links("CVT" /* Codes.CVT */, "https://convertio.co/", "Convertio");
    //* websiteLinks.plus("addNewOther");
    const navBar = new Links("#navBar", "prepend");
    navBar.links("GGL" /* Codes.GGL */, "https://www.google.com/", "Google");
    navBar.links("WNP" /* Codes.WNP */, "https://whanau.aotea.school.nz", "Whanau Portal");
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
    $settings.on("mousedown", (e) => {
        if (e.target !== $settings[0]) {
            e.stopPropagation();
            return;
        }
        // Calculate the shift in mouse position
        const shiftX = e.clientX - $settings[0].getBoundingClientRect().left;
        const shiftY = e.clientY - $settings[0].getBoundingClientRect().top;
        const moveAt = (pageX, pageY) => {
            $settings.css({
                left: `${pageX - shiftX}px`,
                top: `${pageY - shiftY}px`
            });
        };
        const onMouseMove = (e) => { moveAt(e.pageX, e.pageY); };
        // Move the div on mousemove
        $document.on("mousemove", (e) => onMouseMove(e.originalEvent));
        const onMouseUp = () => { $document.off("mousemove"); };
        $document.on("mouseup", onMouseUp);
        // Prevent default drag behavior
        e.preventDefault(); // Prevent text selection
    });
});
//= Maniging the form in settings.html and settings.html
utils.includeHTMLFile("./Plugins/settings.html", $("div#settings"))
    .then(async () => {
    for (const key of ["red", "yellow", "green", "blue", "purple", "default"]) {
        let option = document.getElementById("BaseColor");
        if (option) {
            option = option.querySelector(`option[value=${key === "default" ? "blue" : key}]`);
        }
        else
            throw new Error(`Couldn't find option[value=${key === "default" ? "blue" : key}]`);
        if (option.value === (Settings.BaseColor === "default" ? "blue" : Settings.BaseColor)) {
            console.log("Setting matched,", Settings.BaseColor);
            option.selected = true;
            break;
        }
    }
    for (const key of [1, 2, 3]) {
        let option = document.getElementById("Notifications");
        if (option) {
            option = option.querySelector(`option[value="${key}"]`);
        }
        else
            throw new Error(`Couldn't find option[value="${key}"]`);
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
    const file = await fetchData("./JSON/objects.json");
    if (file.ButtonsObj) {
        for (const [key, value] of Object.entries(file.ButtonsObj)) {
            const modifiers = value.split("!");
            if (modifiers[1] === "unavaliable")
                continue;
            let checked = false;
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
        const buttons = {};
        formData.forEach((value, key) => {
            if (key.startsWith("Buttons[")) {
                const buttonName = key.match(/Buttons\[(.*)\]/)?.[1]; // Extract the button name
                if (buttonName) {
                    buttons[buttonName] = value === "1"; // Convert to boolean
                }
            }
        });
        cookie.set("settings", {
            BaseColor: formData.get("BaseColor"),
            Notifications: parseInt(formData.get("Notifications")),
            DarkMode: formData.get("DarkMode") === "1",
            Tooltips: formData.get("Tooltips") === "1",
            Buttons: buttons
        }, 365 * 5);
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
            message: "Click the Go To Settings button to change the sites settings.<br>" +
                "Click the Change Classes button to change your classes.",
        }, [
            { buttonText: "Go To Settings", buttonFunction: () => $("//settings").show() },
            { buttonText: "Cutomize Classes", buttonFunction: () => redirect("links.html") },
            { buttonText: "Stop Showing", buttonFunction: () => cookie.set("clicked", true) }
        ], true, { width: "700px", position: { right: "20vw", top: "40vh" } });
    }
});
