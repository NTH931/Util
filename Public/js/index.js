var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
import * as Utils from "./utilities.js";
const { Create, cookie } = Utils;
$(function () {
    var _a;
    const settings = JSON.parse((_a = cookie.get("settings")) !== null && _a !== void 0 ? _a : "");
    // Function to create and add pop-out elements from structured data
    function addPopoutElements(parentDivId, jsonObject) {
        const $parentDiv = $("//" + parentDivId);
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
            $.each(jsonObject, function (index, button) {
                const buttonText = button["text"];
                if (buttonText.toLowerCase() === "button 1" || buttonText.toLowerCase() === "button 2" || buttonText.toLowerCase() === "button 3")
                    return;
                const $wrapper = $(`<div>`, { class: 'popout-wrapper' });
                const $buttonElement = $(`<a>`, {
                    class: 'popout whitebg',
                    id: `button${String(index)}`,
                    text: buttonText
                });
                $buttonElement.on('click', function () { window.open(button["location"], '_blank'); });
                $parentDiv.on({
                    mouseenter: () => __awaiter(this, void 0, void 0, function* () {
                        setTimeout(() => {
                            $buttonElement.css({
                                left: "20px",
                                visibility: "visible",
                                opacity: 1,
                                transition: `opacity 0.3s ease, visibility 0.3s ease`
                            });
                        }, 100);
                    }),
                    mouseleave: () => __awaiter(this, void 0, void 0, function* () {
                        setTimeout(() => {
                            $buttonElement.css({
                                visibility: "hidden",
                                opacity: 0,
                                transition: `opacity 0.3s ease, visibility 0.3s ease`
                            });
                        }, 100);
                    })
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
    function fetchData(url) {
        return __awaiter(this, void 0, void 0, function* () {
            console.log(`Fetching data from ${url}`);
            try {
                const response = yield fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = yield response.json();
                return data;
            }
            catch (error) {
                console.error("Error fetching data:", error);
                return null;
            }
        });
    }
    fetchData("../Private/JSON/lists.json")
        .then((data) => {
        var _a;
        if (!data)
            return;
        for (let i = 1; i <= 9; i++) {
            const jsonItems = JSON.parse(localStorage.getItem(`class${i}`) || "[]");
            if (!jsonItems)
                continue;
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
                (_a = document.querySelector('aside')) === null || _a === void 0 ? void 0 : _a.appendChild(divElement);
                // Adding pop-out elements
                if (settings.Tooltips)
                    addPopoutElements(`class${i}`, data[jsonItems.code]);
            }
            catch (_b) {
                console.warn(`No class is defined for iteration ${i}.`);
            }
        }
    })
        .catch(error => alert(error.message));
});
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
    Create.iNotification({
        header: "Welcome to Util!",
        message: "Click the Go To Settings button to change the sites settings.<br>" +
            "Click the Change Classes button to change your classes.",
    }, [
        { buttonText: "Go To Settings", buttonFunction: () => $("//settings").show() },
        { buttonText: "Cutomize Classes", buttonFunction: () => window.location.href = "links.php" },
        { buttonText: "Stop Showing", buttonFunction: () => { cookie.set("clicked", true); } }
    ], true, { width: "700px", position: { right: "20vw", top: "40vh" } });
}
