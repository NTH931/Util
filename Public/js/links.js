import * as Utils from "./utilities.js";
const { classes, redirect, triggerDownload } = Utils;
function setItemInArray(item, index) {
    return localStorage.setItem(`class${index}`, JSON.stringify(item));
}
$(function () {
    const reset = document.getElementById("reset");
    const form = document.getElementById("classes");
    const inputs = document.querySelectorAll("input[type='text']");
    const classNames = document.querySelectorAll("select, input[type='hidden']");
    const fileForm = document.getElementById("template");
    const fileInput = document.getElementById("file");
    const fileLabel = document.getElementById("fileInput");
    // Capture local storage length before clearing
    const localData = localStorage.length;
    $("input[type=text]#class1").trigger("focus");
    reset?.addEventListener("click", (e) => {
        e.preventDefault();
        const choice = window.confirm("Are you sure you want to delete all of your classroom data?");
        if (choice) {
            localStorage.clear();
            console.warn(`User Data deleted! ${localData} classes removed from storage.`);
            alert("User Data deleted!");
            redirect("index.php");
        }
        else {
            console.log("User Data not deleted.");
        }
    });
    form?.addEventListener("keydown", (e) => {
        if (e.shiftKey && e.key === "Enter") {
            const focusedElement = document.activeElement;
            const id = focusedElement.id;
            // Extract and construct the numeric part from the ID
            const idNumber = parseInt(id.match(/\d+$/)?.[0] || "0", 10);
            const nextElementId = id.replace(/\d+$/, (idNumber + 1).toString());
            // Focus the next element if it exists
            if ($(`#${nextElementId}`).length > 0) {
                e.preventDefault();
                $(`#${nextElementId}`).trigger("focus");
            }
        }
    });
    form?.addEventListener("submit", async (e) => {
        e.preventDefault();
        const classData = [];
        for (let i = 0; i < Math.min(classNames.length, inputs.length, 8); i++) {
            const subject = classNames[i].value?.trim() || "";
            let classSubject = classes[subject] || "";
            const link = inputs[i].value?.trim() || "";
            if (i === 0) {
                classSubject = "HuiAko";
            }
            if (subject !== "INVALID" && link !== "") {
                let item = { code: subject, subject: classSubject, link: link };
                console.log(`Variable class${i} set. Values: ${JSON.stringify(item)}`);
                classData.push(item);
            }
            else {
                classData.push({ code: null });
                console.log(`Iteration ${i} had no values: code: ${subject}, subject: ${classSubject}, link: ${link}`);
            }
        }
        if (classData.length > 0) {
            classData.forEach((item, index) => {
                if (item.code && item.subject && item.link) {
                    setItemInArray(item, index + 1);
                }
                else {
                    console.info(`Undefined Item. Defaulting to localStorage item class${index + 1}...`);
                }
            });
            console.log(JSON.stringify(classData));
        }
        else {
            console.error(`ClassData returned an empty array ([])`);
        }
        if (e.submitter.id === "submit&save") {
            try {
                triggerDownload(`Util_${new Date().toDayString()}.json`, classData);
                console.log("Download complete or simulated wait finished.");
            }
            catch (error) {
                console.error("Error during download process:", error);
            }
        }
        else {
            redirect("index.php");
        }
    });
    fileInput?.addEventListener("change", async (e) => {
        const file = e.target.files?.[0];
        if (!file || !file.name.includes("Util") || !file.name.includes(".json")) {
            console.error("File is not a Util.json file / Not found");
            return;
        }
        try {
            const jsonData = JSON.parse(await file.text());
            classNames.forEach((element, index) => {
                if (element instanceof HTMLSelectElement) {
                    for (let i = 0; i < element.options.length; i++) {
                        if (element.options[i]?.value === jsonData[index]?.code) {
                            element.selectedIndex = i;
                            return;
                        }
                    }
                }
                else
                    return;
            });
            inputs.forEach((element, index) => element.value = jsonData[index]?.link ?? "Not Found");
        }
        catch (error) {
            console.error("Error parsing JSON:", error.message);
        }
        $(fileLabel).text("Content Transferred!");
    });
    document.querySelectorAll("input[type='text']").forEach((value, i) => {
        const item = localStorage.getItem(value.id);
        // Check if the item is non-empty and valid JSON before parsing
        if (item) {
            try {
                const result = JSON.parse(item); // Attempt to parse only if there is an item
                if (result !== "") {
                    $(value).removeClass("invalid").addClass("valid");
                }
            }
            catch (error) {
                console.error("Error parsing JSON from localStorage:", error);
            }
        }
    });
});
