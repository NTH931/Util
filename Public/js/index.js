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
const { Create, LocalStorage, Cookie } = Utils;
const $settings = $("#settings");
$settings.hide();
$("#settingsshow").on("click", function () {
    $settings.toggle();
});
$(function () {
    var _a;
    const settings = JSON.parse((_a = Cookie.get("settings")) !== null && _a !== void 0 ? _a : "");
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
            const jsonItems = JSON.parse(LocalStorage.get(`class${i}`) || "[]");
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
const notifi = Create.notification({
    header: "What do you Want?",
    message: "This is a new notification.",
}, false);
