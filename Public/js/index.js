import * as Utils from './utilities.js';
const { iNotification, triggerDownload, cookie, redirect, $document, $window } = Utils;
$.fn.toHTMLElement = function () {
    return this.get(0) ?? null;
};
// Creates 
$(function () {
    const $addClasses = $("#addClasses");
    const $saveTemplate = $("#saveTemplate");
    const $deleteClasses = $("#deleteClasses");
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
            $.each([...jsonObject].reverse(), function (index, button) {
                const buttonText = button["text"];
                if (buttonText.toLowerCase() === "button 1" || buttonText.toLowerCase() === "button 2" || buttonText.toLowerCase() === "button 3")
                    return;
                const $wrapper = $(`<div>`, { class: 'popout-wrapper' });
                const $buttonElement = $(`<a>`, {
                    class: 'popout whitebg',
                    id: `button${String(index)}`,
                    text: buttonText
                });
                $buttonElement.css("background-color", function () {
                    switch (index) {
                        case 0:
                            console.log("Applied l");
                            return "var(--button-bg-lll)";
                        case 1:
                            console.log("Applied ll");
                            return "var(--button-bg-ll)";
                        case 2:
                            console.log("Applied lll");
                            return "var(--button-bg-l)";
                        default:
                            console.log("Applied default");
                            return "var(--button-bg-l)";
                    }
                });
                $buttonElement.css("z-index", index);
                $buttonElement.on('click', function () { window.open(button["location"], '_blank'); });
                $parentDiv.on({
                    mouseenter: async () => {
                        setTimeout(() => {
                            $buttonElement.css({
                                left: "20px",
                                visibility: "visible",
                                opacity: 1,
                                transition: `opacity 0.3s ease, visibility 0.3s ease`
                            });
                        }, 100);
                    },
                    mouseleave: async () => {
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
        }
        catch (error) {
            console.error("Error fetching data:", error);
            return null;
        }
    }
    fetchData("../Private/JSON/lists.json")
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
            console.log(`#class7 found`);
            $addClasses.html("<b>~ </b>Edit Classes");
        }
        else {
            console.error(`#class7 not found`);
            $addClasses.html("<b>+ </b>Add Classes");
        }
        // SaveTemplate
        if (document.querySelector("aside > div#class1")) {
            console.log("#class1 found");
            $saveTemplate.show();
        }
        else {
            console.error("#class1 not found");
            $saveTemplate.hide();
        }
        // DeleteClasses
        if (document.querySelector("aside > div#class1")) {
            console.log("#class1 found");
            $deleteClasses.show();
        }
        else {
            console.error("#class1 not found");
            $deleteClasses.hide();
        }
    })
        .catch(error => alert(error.message));
});
// DeleteClasses
$(function () {
    $("#deleteClasses").on("click", function () {
        let result = confirm("Delete All Classes?");
        if (result) {
            localStorage.clear();
            alert("Classes Reset");
            redirect("index.php");
        }
    });
});
// Savetemplate
$(function () {
    $("#saveTemplate").on("click", function () {
        const classData = [];
        // Iterate over localStorage keys in the sequence they are retrieved
        for (let i = 1; i < localStorage.length + 1; i++) {
            const value = localStorage.getItem(`class${i}`) ?? "";
            if (value !== null) {
                // Matching keys such as class1, class2, ..., class8
                try {
                    // Parse and add to classData array in the order of access
                    const item = JSON.parse(value);
                    const itemcode = item.code ?? "";
                    const itemsubject = item.subject ?? "";
                    const itemlink = item.link ?? "";
                    console.log(i);
                    console.log(value);
                    classData.push({ code: itemcode, subject: itemsubject, link: itemlink });
                }
                catch (e) {
                    console.error("Error parsing JSON from localStorage:", e);
                }
            }
            else {
                console.error(`class${i} does not have any items or does not exist.`);
            }
        }
        triggerDownload(`Util_${new Date().toDayString()}.json`, classData);
    });
});
// Button.on("click") popouts
$(function () {
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
// Cookies
if (!cookie.get("page_visited")) {
    cookie.set("page_visited", true, 365 * 5);
    cookie.set("settings", {
        // Value: Common colours
        "Base-Color": "default",
        // Value: 1=all, 2=important_popup_only, 3=notification_panel_only
        "Notifications": 1,
        // Value: Boolean
        "Tooltips": true,
        // Value: Boolean
        "Dark-Mode": true,
        // Assoc Array
        "Buttons": {
            "GGL": null,
            "WNP": true,
            "QCT": false,
            "EDC": true,
            "ATC": true,
            "ATL": true,
            "ATN": null,
            "NQA": true,
            "NCR": true,
            "GML": true,
            "DRV": true,
            "CLR": true,
            "DCS": true,
            "SLD": true,
            "SHT": true,
            "FRM": true,
            "STS": true,
            "KHT": true,
            "BLK": true,
            "RMB": true,
            "USC": true,
            "CVT": true
        }
    });
    location.reload();
}
if (!cookie.get("clicked")) {
    iNotification({
        header: "Welcome to Util!",
        message: "Click the Go To Settings button to change the sites settings.<br>" +
            "Click the Change Classes button to change your classes.",
    }, [
        { buttonText: "Go To Settings", buttonFunction: () => $("//settings").show() },
        { buttonText: "Cutomize Classes", buttonFunction: () => redirect("links.php") },
        { buttonText: "Stop Showing", buttonFunction: () => { cookie.set("clicked", true); } }
    ], true, { width: "700px", position: { right: "20vw", top: "40vh" } });
}
