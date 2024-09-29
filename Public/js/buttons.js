import * as utils from './utilities.js';
const { fetchData } = utils;
$(async function () {
    const response = await fetchData("../Private/JSON/objects.json");
    $(".install").each(function (_, element) {
        const $this = $(element);
        const id = $this.id;
        $this.on("click", function () {
            if (id && response.ButtonsObj[id]) {
                const buttonName = response.ButtonsObj[id];
                console.log("Installing:", buttonName);
                // Perform installation logic here
            }
            else {
                console.log("Not installing.");
            }
        });
    });
});
