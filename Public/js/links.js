import * as Utils from "./utilities.js";
const { classes } = Utils;
$(function () {
    const reset = document.getElementById("reset");
    const form = document.getElementById("classes");
    const inputs = document.querySelectorAll("input[type='text']");
    const classNames = document.querySelectorAll("select, input[type='hidden']");
    const localData = localStorage.length;
    reset === null || reset === void 0 ? void 0 : reset.addEventListener("click", (e) => {
        e.preventDefault();
        const choice = window.confirm("Are you sure you want to delete all of your classroom data?");
        if (choice) {
            const deletion = (() => { try {
                localStorage.clear();
                return true;
            }
            catch (_a) {
                return false;
            } })();
            if (deletion) {
                console.warn(`User Data deleted! ${localData} classes removed from storage.`);
                alert("User Data deleted!");
            }
            else {
                console.error(`User data not deleted.`);
                alert("Processing error.");
            }
        }
        else {
            console.log("User Data not deleted.");
        }
    });
    form === null || form === void 0 ? void 0 : form.addEventListener("submit", (e) => {
        var _a, _b;
        e.preventDefault();
        const classData = [];
        for (let i = 0; i < Math.min(classNames.length, inputs.length, 8); ++i) {
            const subject = ((_a = classNames[i].value) === null || _a === void 0 ? void 0 : _a.trim()) || "";
            let classSubject = classes[subject] || "";
            const link = ((_b = inputs[i].value) === null || _b === void 0 ? void 0 : _b.trim()) || "";
            if (i === 0 && subject === "") {
                classSubject = "HuiAko";
            }
            if (subject !== "INVALID" && link !== "") {
                let item = { code: subject, subject: classSubject, link: link };
                console.log(`Variable class${i} set. Values: ` + JSON.stringify(item) + "(classes.js:18:21)");
                classData.push(item);
            }
            else {
                classData.push({ code: "", subject: "", link: "" });
                console.warn(`
          Iteration ${i} returned no values (subject: ${subject !== "INVALID" ? subject : "null"}, link: ${link !== "" ? link : "null"}) 
              at JSON.<Object> (classes.js:22:21)
        `);
            }
        }
        if (classData.length > 0) {
            classData.forEach((item, index) => {
                if (item.code) {
                    localStorage.setItem(`class${index + 1}`, JSON.stringify(item));
                }
            });
            console.log(JSON.stringify(classData));
        }
        else {
            console.error(`
        ClassData returned an empty array ([])
            at (classes.js:53:14)
      `);
        }
        try {
            window.location.href = "index.php";
        }
        catch (error) {
            throw new Error(error);
        }
    });
});
