import * as utils from './utilities.js';
const { Codes, Settings } = utils;
// $(async function () {
//   const response = await fetchData("./JSON/objects.json");
//   $(".install").each(function (_, element: HTMLElement) {
//     const $this = $(element);
//     const id = $this.id;
//     $this.on("click", function () {
//       if (id && response.ButtonsObj[id]) {
//         const buttonName = response.ButtonsObj[id];
//         console.log("Installing:", buttonName);
//         Perform installation logic here
//       } else {
//         console.log("Not installing.")
//       }
//     });
//   });
// });
$(() => {
    class Buttons {
        element;
        constructor(element) {
            this.element = element;
        }
        buttonSettings(classid, title, description, url) {
            let content;
            if (Settings["Buttons"][classid], classid) {
                content = "<br><b class='green'>&check; Installed</b></b>";
            }
            else {
                content = `
          <br><b class="red" >× Not installed </b>
          <br><button class="install" id = "{$id->value}">Install</button>
        `;
            }
            $(this.element).append(`
        <div class="contain" >
          <a href="${url ?? "#"}" target="_blank"> <ul>${title} </ul></a >
          <h4>${description}
            ${content}
          </h4>
        </div>
        <br>
      `);
        }
    }
    const aoteaButtons = new Buttons("div#NewAotea");
    aoteaButtons.buttonSettings("ATL" /* Codes.ATL */, "Aotea Library", "The Aotea College library website. Used for finding, reserving, and renewing books.", null);
    aoteaButtons.buttonSettings("DRV" /* Codes.DRV */, "Google Drive", "Google drive is used for storing Docs, Slides, Sheets, Forms and other drive-related items.", "https://drive.google.com/drive/my-drive");
    aoteaButtons.buttonSettings("CML" /* Codes.CML */, "Chrome Music Lab", "Chrome Music Lab is a musical website where you can compose songs, for free!", null);
});
