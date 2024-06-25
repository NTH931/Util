import { classes, Cookie, protoMethod } from "./utilities.js";

$(document).ready(() => {
  const reset = document.getElementById("reset")
  const form = document.getElementById("classes");
  const inputs = document.querySelectorAll("input[type='text']");
  const localData = Cookie.length;
  const allCookies = document.cookie;

  protoMethod(Object, "isEmpty", function() {
    return Object.keys(this).length === 0 && this.constructor === Object;
  });

  reset.addEventListener("click", (e) => {
    e.preventDefault();
    const choice = window.confirm("Are you sure you want to delete all of your classroom data?");
    if (choice) {
      for (let i = 1; i <= 8; i++) {
        Cookie.delete(`class${i}`);
      }

      console.warn(`User Data deleted! ${localData} classes removed from storage.`);
      alert("User Data deleted!");
    } else {
      console.log("User Data not deleted.")
    }
  });

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const classNames = document.querySelectorAll("select, input[type='hidden']");
    const classData = [];

    for (let i = 0; i < 8; ++i) {
      const subject = classNames[i].value?.trim() || "";
      const classSubject = classes[subject] || "";
      const link = inputs[i].value?.trim() || "";

      if ( i === 0 && subject === "" ) { classSubject = "HuiAko"; }


      if (subject !== "INVALID" && link !== "") {
        let item = {code: subject, subject: classSubject, link: link};

        console.log(`Variable class${i} set. Values: ` + JSON.stringify(item) + "(classes.js:18:21)");
        classData.push(item);
      } else {
        classData.push({});
        console.warn(`
          Iteration ${i} returned no values (subject: ${subject !== "INVALID" ? subject : "null"}, link: ${link !== "" ? link : "null"}) 
              at JSON.<Object> (classes.js:22:21)
        `);
      }
    }

    const date = new Date();

    if (classData.length > 0) {
      classData.forEach((item, index) => {
        if (!item.isEmpty()) {
          Cookie.set(`class${index + 1}`, JSON.stringify(item), date.getFullYear() + 1);
        }
      });
      console.log(JSON.stringify(classData));
    } else {
      console.error(`
        ClassData returned an empty array ([])
            at (classes.js:53:14)
      `);
    }

    try {
      //window.location = "index.php";
    } catch (e) {
      throw new Error(e);
    }
  });
});