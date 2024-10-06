import * as utils from "./utilities.js";
const { classes, redirect, triggerDownload } = utils;

function setItemInArray(item: any, index: int) {
  return localStorage.setItem(`class${index}`, JSON.stringify(item));
}

const form = document.getElementById("classes") as HTMLFormElement | null;

//* For the Form
$(() => {
  const reset = document.getElementById("reset") as HTMLElement | null;
  const inputs = document.querySelectorAll<HTMLInputElement>("input[type='text']");
  const classNames = document.querySelectorAll<HTMLSelectElement | HTMLInputElement>("select, input[type='hidden']");

  const fileForm = document.getElementById("template") as HTMLFormElement | null;
  const fileInput = document.getElementById("file") as HTMLInputElement | null;
  const fileLabel = document.getElementById("fileInput") as HTMLLabelElement;
  
  // Capture local storage length before clearing
  const localData = localStorage.length;

  $("input[type=text]#class1").trigger("focus");

  reset?.addEventListener("click", (e: Event) => {
    e.preventDefault();
    const choice = window.confirm("Are you sure you want to delete all of your classroom data?");
    if (choice) {
      localStorage.clear();
      console.warn(`User Data deleted! ${localData} classes removed from storage.`);
      alert("User Data deleted!");
      redirect("index.php");
    } else {
      console.log("User Data not deleted.");
    }
  });

  form?.bindShortcut("shift+enter", (e: KeyboardEvent) => {
    const focusedElement = document.activeElement as HTMLElement;
    const id = focusedElement.id;
    
    // Extract and construct the numeric part from the ID
    const idNumber = parseInt(id.match(/\d+$/)?.[0] || "0", 10);
    const nextElementId = id.replace(/\d+$/, (idNumber + 1).toString());

    // Focus the next element if it exists
    if ($(`#${nextElementId}`).length > 0) {
      e.preventDefault();
      $(`#${nextElementId}`).trigger("focus");
    }
  });

  form?.addEventListener("submit", (e: any) => {
    e.preventDefault();
    const classData: ClassData[] = [];

    for (let i = 0; i < Math.min(classNames.length, inputs.length, 8); i++) {
      const subject: string = classNames[i].value?.trim() || "";
      let classSubject: string = classes[subject] || "";
      const link: string = inputs[i].value?.trim() || "";

      if (i === 0) { classSubject = "HuiAko"; }

      if (subject !== "INVALID" && link !== "") {
        const item: ClassData = { code: subject, subject: classSubject, link: link };

        console.log(`Variable class${i} set. Values: ${JSON.stringify(item)}`);
        classData.push(item);
      } else {
        classData.push({code: null});
        console.log(`Iteration ${i} had no values: code: ${subject}, subject: ${classSubject}, link: ${link}`);
      }
    }

    if (classData.length > 0) {
      classData.forEach((item: any, index: int) => {
        if (item.code && item.subject && item.link) {
          setItemInArray(item, index + 1);
        } else {
          console.info(`Undefined Item. Defaulting to localStorage item class${index + 1}...`);
        }
      });
      console.log(JSON.stringify(classData));
    } else {
      console.error(`ClassData returned an empty array ([])`);
    }

    if ((e.submitter as HTMLElement).id === "submit&save") {
      try {
        triggerDownload(`Util_${new Date().toDayString()}.json`, classData);

        console.log("Download complete or simulated wait finished.");
      } catch (error) {
        console.error("Error during download process:", error);
      }
    } else {
      redirect("index.php");
    }
  });

  fileInput?.addEventListener("change", async (e: Event) => {
    const file = (e.target as HTMLInputElement).files?.[0];

    if (!file || !file.name.includes("Util") || !file.name.includes(".json")) {
      console.error("File is not a Util.json file / Not found");
      return;
    }

    try {
      const jsonData: ClassData[] = JSON.parse(await file.text());
  
      classNames.forEach((element: HTMLInputElement | HTMLSelectElement, index: int) => {
        if (element instanceof HTMLSelectElement) {
          for (let i = 0; i < element.options.length; i++) {
            if (element.options[i]?.value === jsonData[index]?.code) {
              element.selectedIndex = i;
              return;
            }
          }
        } else return;
      });
  
      inputs.forEach((element: HTMLInputElement, index: int) => {
        if (jsonData[index].link) {
          if (/https?:\/\/classroom\.google\.com\/.{5,}/.test(jsonData[index].link)) {
            element.value = jsonData[index]?.link;
          } else {
            throw new Error("Link did not pass the RegExp");
          }
        } else {
          throw new Error("Could not assign value");
        }
      });
    } catch (error: any) {
      console.error("Error parsing JSON:", error.message);
    }
    $(fileLabel).text("Content Transferred!");
  });

  document.querySelectorAll("input[type='text']").forEach((value: Element) => {
    const item = localStorage.getItem(value.id);
  
    // Check if the item is non-empty and valid JSON before parsing
    if (item) {
      try {
        const result: any = JSON.parse(item); // Attempt to parse only if there is an item
        if (result) {
          $(value).removeClass("invalid").addClass("valid");
        }
      } catch (error) {
        console.error("Error parsing JSON from localStorage:", error);
      }
    }
  });
});

//= Inserting form data
$(() => {
  form?.querySelectorAll("select").forEach(value => {
    value.innerHTML = `
      <option value="INVALID" hidden selected>Pick a Subject</option>
      <option value="INT">Intergrated Studies</option>
      <option value="INS">Intergrated Studies - Neuro-Diverse</option>
      <option value="ENG">English</option>
      <option value="MAT">Maths</option>
      <option value="SCI">Science</option>
      <option value="AHI">Aotearoa Histories</option>
      <option value="HPE">Health & PE</option>

      <option value="HEA">HPE - Health & Wellbeing</option>
      <option value="PEO">HPE - Physical Education Outdoors</option>
      <option value="PED">HPE - Physical Education</option>
      <option value="PES">HPE - Sports And Training</option>

      <option value="TGC">Technology - Coding For Gaming</option>
      <option value="TDE">Technology - Digital Technologies</option>
      <option value="DTE">Technology - Digital Technology Enviroments</option>
      <option value="TPD">Technology - Product Design And Construction</option>
      <option value="TBT">Technology - Bio Technology</option>
      <option value="TDV">Technology - Architecture And Product Design</option>
      <option value="TFD">Technology - Food Around The World</option>
      <option value="TTX">Technology - Fashion And Textiles</option>
      <option value="JDT">Technology - Jewellery And Product Design</option>
      <option value="CAR">Technology - Carpentry</option>
      <option value="HOS">Technology - Hospitality</option>
      <option value="PHT">Technology - Photography</option>

      <option value="ARP">Art - Painting</option>
      <option value="ARD">Art - Design</option>
      <option value="ART">Visual Art - Art</option>

      <option value="MUS">Performing Arts - Music General</option>
      <option value="MUJ">Performing Arts - Music Jazz</option>
      <option value="DAN">Performing Arts - Dance</option>
      <option value="DRA">Performing Arts - Drama</option>
      <option value="MPA">Performing Arts - Maori Performing Arts</option>

      <option value="FSI">Science - Forensics Science</option>
      <option value="SFC">Science - Food Chemistry</option>
      <option value="SSU">Science - Space And Us</option>
      <option value="SNS">Science - The Nature Of Science</option>
      <option value="SCB">Science - Chemistry And Biology</option>
      <option value="SPS">Science - Physics And Space Science</option>
      <option value="BIO">Science - Biology</option>
      <option value="CHE">Science - Chemistry</option>
      <option value="PHY">Science - Physics</option>
      <option value="ELS">Science - Enviromental Life Science</option>

      <option value="FRE">Languages - French</option>
      <option value="FRA">Languages - French Advanced</option>
      <option value="JPN">Languages - Japanese</option>
      <option value="JPA">Languages - Japanese Advanced</option>
      <option value="MDR">Languages - Mandarin</option>
      <option value="MDA">Languages - Mandarin Advanced</option>
      <option value="MAO">Languages - Maori</option>
      <option value="MAA">Languages - Maori Advanced</option>
      <option value="SAM">Languages - Te Kura Samoan</option>
      <option value="EPS">Languages - English Proficiency Studies</option>
      <option value="PWR">English - Power Of The Word</option>

      <option value="BUS">Social Science - Business Studies</option>
      <option value="COM">Social Science - Commerce - Money Talks</option>
      <option value="COT">Social Science - Interenational Travel</option>
      <option value="GEO">Social Science - Geography</option>
      <option value="HIS">Social Science - History</option>
      <option value="CLS">Social Science - Classical Studies</option>
      <option value="ECC">Social Science - Economics</option>
      <option value="FIN">Social Science - Financial Capability</option>
      <option value="MED">Social Science - Media Studies</option>
      <option value="PSY">Social Science - Pyschology</option>
      <option value="TOU">Social Science - Tourism</option>

      <option value="ENGA">11 ENG 1 - Sport And Society</option>
      <option value="ENGB">11 ENG 1 - English And The Enviroment</option>
      <option value="ENGC">11 ENG 1 - Maori And Pacific Voices</option>
      <option value="ENGD">11 ENG 1 - Conspiracy Theories</option>
      <option value="ENGF">11 ENG 1 - Dystopia</option>
      <option value="ENGG">11 ENG 1 - Messages In Music</option>
      <option value="ENGH">11 ENG 1 - Modern Mythic</option>
      <option value="ENGJ">11 ENG 2 - NZ Culture In Film</option>
      <option value="ENGK">11 ENG 2 - It's The Little Things</option>
      <option value="ENGL">11 ENG 2 - What Do They Have To Say?</option>
      <option value="ENGM">11 ENG 2 - Poetry Power</option>
      <option value="ENGN">11 ENG 2 - Maori And Pacific Voices 2</option>
      <option value="ENGQ">11 ENG 2 - Wahine Toa</option>

      <option value="MAC">Mathematics - Mathematics With Calculus</option>
      <option value="MAS">Mathematics - Mathematics With Statistics</option>

      <option value="GAT">Pathways - Gateway Level ()</option>
      <option value="PAT">Pathways - Pathways Level ()</option>
      <option value="WTA">Pathways - Wellington Trades Academy</option>

      <option value="SPEC">Learning Support - SPEC</option>
      <option value="LST">Learning Support - Transition</option>
    `;
  });
});