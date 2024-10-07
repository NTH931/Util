/** Constructs date objects from milliseconds up to the hour */
class Time {
    hours;
    minutes;
    seconds;
    milliseconds;
    date;
    constructor(hours, minutes, seconds, milliseconds) {
        this.date = new Date();
        this.hours = hours ?? this.date.getHours();
        this.minutes = minutes ?? this.date.getMinutes();
        this.seconds = seconds ?? this.date.getSeconds();
        this.milliseconds = milliseconds ?? this.date.getMilliseconds();
        if (hours !== undefined && (hours < 0 || hours >= 24))
            throw new SyntaxError("Hours must be between 0 and 23.");
        if (minutes !== undefined && (minutes < 0 || minutes >= 60))
            throw new SyntaxError("Minutes must be between 0 and 59.");
        if (seconds !== undefined && (seconds < 0 || seconds >= 60))
            throw new SyntaxError("Seconds must be between 0 and 59.");
        if (milliseconds !== undefined && (milliseconds < 0 || milliseconds >= 1000))
            throw new SyntaxError("Milliseconds must be between 0 and 999.");
    }
    setHours(hours) {
        if (hours < 0 || hours >= 24) {
            throw new SyntaxError("Hours must be between 0 and 23.");
        }
        this.hours = hours;
    }
    setMinutes(minutes) {
        if (minutes < 0 || minutes >= 60) {
            throw new SyntaxError("Minutes must be between 0 and 59.");
        }
        this.minutes = minutes;
    }
    // Additional setters
    setSeconds(seconds) {
        if (seconds < 0 || seconds >= 60) {
            throw new SyntaxError("Seconds must be between 0 and 59.");
        }
        this.seconds = seconds;
    }
    setMilliseconds(milliseconds) {
        if (milliseconds < 0 || milliseconds >= 1000) {
            throw new SyntaxError("Milliseconds must be between 0 and 999.");
        }
        this.milliseconds = milliseconds;
    }
    getHours() { return this.hours; }
    getMinutes() { return this.minutes; }
    getSeconds() { return this.seconds; }
    getMilliseconds() { return this.milliseconds; }
    getTime() {
        return (this.hours * 3600000 + // Convert hours to milliseconds
            this.minutes * 60000 + // Convert minutes to milliseconds
            this.seconds * 1000 + // Convert seconds to milliseconds
            this.milliseconds // Add milliseconds
        );
    }
    toString() { return `${this.hours.toString().padStart(2, '0')}:${this.minutes.toString().padStart(2, '0')}`; }
    toISOString(dateInYears) { return `${dateInYears}T${this.toString()}:00.000Z`; }
    addMinutes(minutesToAdd) {
        const totalMinutes = this.hours * 60 + this.minutes + minutesToAdd;
        const newHours = Math.floor((totalMinutes % 1440) / 60);
        const newMinutes = totalMinutes % 60;
        return new Time(newHours, newMinutes);
    }
    subtractMinutes(minutesToSubtract) {
        const totalMinutes = this.hours * 60 + this.minutes - minutesToSubtract;
        const newHours = Math.floor((totalMinutes % 1440 + 1440) / 60) % 24;
        const newMinutes = ((totalMinutes % 60) + 60) % 60;
        return new Time(newHours, newMinutes);
    }
    static fromISOString(isoString) {
        const match = isoString.match(/T(\d{2}):(\d{2})/);
        if (match) {
            const hours = parseInt(match[1], 10);
            const minutes = parseInt(match[2], 10);
            return new Time(hours, minutes);
        }
        throw new Error("Invalid ISO string format.");
    }
}
// Functions
function isset(...variables) {
    for (const variable of variables) {
        if (variable === null || variable === undefined) {
            return false;
        }
    }
    return true;
}
function addMethod(Class, methodDefinition, options = { enumerable: false }) {
    // Normalize method definitions and classes into arrays
    const methods = Array.isArray(methodDefinition) ? methodDefinition : [methodDefinition];
    const classes = Array.isArray(Class) ? Class : [Class];
    // Handle the case where both Class and methodDefinition are arrays
    if (Array.isArray(Class) && Array.isArray(methodDefinition)) {
        // Check that both arrays are of the same length
        if (classes.length !== methods.length) {
            return [false, new Error('Class and methodDefinition arrays must be of the same length')];
        }
        // Map methods to corresponding classes
        for (let i = 0; i < classes.length; i++) {
            const cls = classes[i];
            const method = methods[i];
            if (typeof cls !== 'object' && typeof cls !== 'function') {
                return [false, new TypeError('Each class must be an object or function')];
            }
            if (typeof method !== 'function' || !method.name) {
                return [false, new TypeError('Each method must be a named function')];
            }
            try {
                const methodName = method.name;
                // Define method on a class (function prototype)
                if (typeof cls === 'function') {
                    Object.defineProperty(cls.prototype, methodName, {
                        value: method,
                        ...options,
                    });
                }
                else {
                    // Define method directly on an object
                    Object.defineProperty(cls, methodName, {
                        value: method,
                        ...options,
                    });
                }
            }
            catch (error) {
                return [false, error];
            }
        }
    }
    else {
        // Original handling when Class and methodDefinition are not both arrays
        for (const cls of classes) {
            if (typeof cls !== 'object' && typeof cls !== 'function') {
                return [false, new TypeError('Each class must be an object or function')];
            }
            for (const method of methods) {
                if (typeof method !== 'function' || !method.name) {
                    return [false, new TypeError('Each method must be a named function')];
                }
                try {
                    const methodName = method.name;
                    if (typeof cls === 'function') {
                        Object.defineProperty(cls.prototype, methodName, {
                            value: method,
                            ...options,
                        });
                    }
                    else {
                        Object.defineProperty(cls, methodName, {
                            value: method,
                            ...options,
                        });
                    }
                }
                catch (error) {
                    return [false, error];
                }
            }
        }
    }
    return [true, null];
}
function addVariable(target, variables, options = { writable: false, enumerable: false, configurable: false }) {
    // Check if the first argument is either an object or a function
    if (typeof target !== 'object' && typeof target !== 'function') {
        return [false, new TypeError('First argument must be an object or function')];
    }
    // Check if the second argument is an object
    if (typeof variables !== 'object' || variables === null) {
        return [false, new TypeError('Second argument must be an object containing variables')];
    }
    try {
        // Define variables on a class (function prototype)
        if (typeof target === 'function') {
            for (const [key, value] of Object.entries(variables)) {
                Object.defineProperty(target.prototype, key, {
                    value,
                    writable: options.writable ?? false,
                    enumerable: options.enumerable ?? false,
                    configurable: options.configurable ?? false,
                });
            }
        }
        // Define variables directly on an object
        else if (typeof target === 'object') {
            for (const [key, value] of Object.entries(variables)) {
                Object.defineProperty(target, key, {
                    value,
                    writable: options.writable ?? false,
                    enumerable: options.enumerable ?? false,
                    configurable: options.configurable ?? false,
                });
            }
        }
        return [true, null];
    }
    catch (error) {
        // Return false with the error if something goes wrong during property definition
        return [false, error];
    }
}
function media(rule, value) {
    const mediaQueryString = `(${rule}: ${value})`;
    return window.matchMedia(mediaQueryString).matches;
}
/**
 * @param page The page to go to
 * @param replaceCurrentPage Removes the current page from the session history and navigates to the given URL.
 */
function redirect(page, replaceCurrentPage = false) {
    if (!replaceCurrentPage)
        window.location.href = page;
    else
        window.location.replace(page);
}
function reload() {
    window.location.reload();
}
function notification(content, importance = false, options = {}, lingers = true) {
    if ((importance ? 2 : 1) < JSON.parse(cookie.get("settings") ?? "")?.Notifications)
        return Promise.reject("Notiification was hidden based on user preferences.");
    const createdAt = new Time();
    const contentHeader = typeof content === 'string' ? '' : content.header;
    const contentMessage = typeof content === 'string' ? content : content.message;
    const $notification = $(`
        <div class="notifi">
          <div class="notifi-content">
            <span class="dismis">&times;</span>
            ${contentHeader ? `<p class='notifi-header'>${contentHeader}</p>` : ''}
            <p class="notifi-message">${contentMessage}</p>
          </div>
        </div>
      `);
    $("footer").after($notification);
    $('.notifi').css({
        display: 'block',
        position: 'fixed',
        zIndex: 1,
        left: options.position?.left || 'auto',
        top: options.position?.top || 'auto',
        right: options.position?.right || '10px',
        bottom: options.position?.bottom || '10px',
        width: options.width || '300px',
        height: options.height || 'auto',
        overflow: 'auto',
    });
    $('.dismis').on({
        mouseenter: function () { $(this).css('color', '#fff'); },
        mouseleave: function () { $(this).css('color', '#888'); },
        click: function () {
            $('.notifi').fadeOut(1000);
            return { action: 'closed', createdAt, interactedWithin: Date.now() - createdAt.getTime() };
        }
    });
    const time = options.time;
    return new Promise((resolve) => {
        setTimeout(() => {
            $('.notifi').fadeOut(1000, function () {
                if (lingers) {
                    const $notificationBoard = $('.notification-board');
                    if ($notificationBoard.length)
                        $(this).appendTo($notificationBoard);
                }
                resolve({ action: 'timeout', createdAt, interactedWithin: Date.now() - createdAt.getTime() });
            });
        }, time ? time * 1000 : 7500);
    });
}
function iNotification(content, buttons, importance = true, options = {}, lingers = true) {
    if ((importance ? 2 : 1) < JSON.parse(cookie.get("settings") ?? "")?.Notifications)
        return Promise.reject("Notiification was hidden based on user preferences.");
    const createdAt = new Time();
    const contentHeader = typeof content === 'string' ? '' : content.header;
    const contentMessage = typeof content === 'string' ? content : content.message;
    if (buttons.length > 4) {
        console.error("Maximum of 4 buttons allowed");
        return { action: 'timeout', createdAt, interactedWithin: 0 };
    }
    const $notification = $(`
      <div class="notifi">
        <div class="notifi-content">
          ${contentHeader ? `<p class='notifi-header'>${contentHeader}</p>` : ''}
          <p class="notifi-message">${contentMessage}</p>
          <div class="notifi-buttons">
            ${buttons.map((button, index) => `
              <button class="notifi-button" data-index="${index}">${button.buttonText}</button>
            `).join('')}
          </div>
        </div>
      </div>
      `);
    $("footer").after($notification);
    $('.notifi').css({
        display: 'block',
        position: 'fixed',
        zIndex: 1,
        left: options.position?.left || 'auto',
        top: options.position?.top || 'auto',
        right: options.position?.right || '10px',
        bottom: options.position?.bottom || '10px',
        width: options.width || '300px',
        height: options.height || 'auto',
        overflow: 'auto',
    });
    $('.notifi-button').on({
        mouseenter: function () { $(this).css('color', '#fff'); },
        mouseleave: function () { $(this).css('color', '#888'); },
        click: function () {
            const index = $(this).data('index');
            if (index !== undefined && buttons[index]?.buttonFunction) {
                buttons[index].buttonFunction?.();
                $('.notifi').fadeOut(1000, () => {
                    return { action: 'buttonClicked', buttonIndex: index, createdAt, interactedWithin: Date.now() - createdAt.getTime() };
                });
            }
        }
    });
    const time = options.time;
    setTimeout(() => {
        $('.notifi').fadeOut(1000, function () {
            if (lingers) {
                const $notificationBoard = $('.notification-board');
                if ($notificationBoard.length)
                    $(this).appendTo($notificationBoard);
            }
            return { action: 'timeout', createdAt, interactedWithin: Date.now() - createdAt.getTime() };
        });
    }, time ? time * 1000 : 15000);
}
async function fetchData(url, json = true) {
    console.log(`Fetching data from ${url}`);
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        let data;
        if (json) {
            data = await response.json();
        }
        else {
            data = response;
        }
        return data;
    }
    catch (error) {
        console.error("Error fetching data:", error);
        return null;
    }
}
function includeHTMLFile(fileLocation, targetElement) {
    return fetch(fileLocation)
        .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
        .then(html => {
        if (targetElement instanceof HTMLElement) {
            targetElement.innerHTML = html;
        }
        else {
            targetElement.html(html);
        }
    })
        .catch(error => {
        console.error('Error loading settings:', error);
        // Return a rejected promise to handle errors correctly
        return Promise.reject(error);
    });
}
function popup(message, options = {}) {
    const createdAt = new Time();
    const $popup = $(`
      <div id="popup">
        <div class="popup-content">
          <span class="close">&times;</span>
          <p id="popup-message">${message}</p>
        </div>
      </div>
    `);
    $("html").append($popup);
    $('#popup').css({
        display: 'block',
        position: 'fixed',
        zIndex: 1,
        left: options.left || '0',
        top: options.top || '0',
        width: options.width || '100%',
        height: options.height || '100%',
        overflow: 'auto',
        backgroundColor: 'rgba(0,0,0,0.4)',
    });
    $('.popup-content').css({
        backgroundColor: 'var(--background-color-d)',
        margin: '15% auto',
        padding: '20px',
        border: '1px solid #888',
        width: '80%',
    });
    $('.close').css({
        color: '#aaa',
        float: 'right',
        fontSize: '28px',
        fontWeight: 'bold',
        cursor: 'pointer',
        transition: "color 0.4s ease",
    });
    setTimeout(() => {
        $('#popup').fadeOut(60000);
        return { action: 'unclosed', createdAt, interactedWithin: null, closedAt: null };
    });
    $('.close').on({
        mouseenter: function () { $(this).css('color', '#fff'); },
        mouseleave: function () { $(this).css('color', '#888'); },
        click: function () {
            $('#popup').fadeOut(1000);
            return { action: 'closed', createdAt, interactedWithin: Date.now() - createdAt.getTime(), closedAt: Date.now() };
        }
    });
}
function triggerDownload(filename, data) {
    try {
        // Create a new Blob object using JSON data
        const blob = new Blob([JSON.stringify(data, null, 2)], { type: "application/json" });
        // Create a link element
        const link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        link.download = filename;
        // Append link to body and trigger click for download
        document.body.appendChild(link);
        link.click();
        // Clean up by removing the link
        document.body.removeChild(link);
        window.URL.revokeObjectURL(link.href);
    }
    catch (error) {
        throw new Error(error.message);
    }
}
;
// Implement the function
function querySelect(selector, all) {
    if (all) {
        return document.querySelectorAll(selector); // Returns all matching elements
    }
    return document.querySelector(selector); // Returns the first matching element
}
// Extensions of Globals (Requires Modifying Interfaces)
addMethod([document, window, HTMLElement], function bindShortcut(shortcut, callback) {
    document.addEventListener('keydown', (event) => {
        const keyboardEvent = event;
        const keys = shortcut
            .trim()
            .toLowerCase()
            .split("+");
        // Separate out the modifier keys and the actual key
        const modifiers = keys.slice(0, -1);
        const finalKey = keys[keys.length - 1];
        const modifierMatch = modifiers.every((key) => {
            if (key === 'ctrl' || key === 'control')
                return keyboardEvent.ctrlKey;
            if (key === 'alt')
                return keyboardEvent.altKey;
            if (key === 'shift')
                return keyboardEvent.shiftKey;
            if (key === 'meta' || key === 'windows' || key === 'command')
                return keyboardEvent.metaKey;
            return false;
        });
        // Check that the pressed key matches the final key
        const keyMatch = finalKey === keyboardEvent.key.toLowerCase();
        if (modifierMatch && keyMatch) {
            callback(keyboardEvent);
        }
    });
});
addMethod(Date, function toDayString() {
    const day = String(this.getDate()).padStart(2, '0');
    const month = String(this.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const year = this.getFullYear();
    return `${day}-${month}-${year}`;
}, {
    writable: true,
    enumerable: false,
    configurable: true
});
// Variables
const cookie = {
    set(name, value, daysToExpire, path = "/") {
        let expirationDate = "";
        if (daysToExpire) {
            const date = new Date();
            date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
            expirationDate = "; expires=" + date.toUTCString();
        }
        document.cookie = `${name}=${encodeURIComponent(JSON.stringify(value))}${expirationDate}; path=${path}`;
    },
    get(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(name + '='))
                return decodeURIComponent(cookie.substring(name.length + 1));
        }
        return null;
    },
    getAll() {
        const allCookies = [];
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            allCookies.push(cookie);
        }
        return allCookies;
    },
    delete(name) {
        try {
            document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            return true;
        }
        catch {
            return false;
        }
        ;
    },
    clear() {
        try {
            const cookies = document.cookie.split("; ");
            for (const cookie of cookies) {
                const name = cookie.split("=")[0];
                this.delete(name);
            }
            return true;
        }
        catch {
            return false;
        }
    }
};
const classes = {
    "HuiAko": "HuiAko",
    "INT": "Integrated Studies",
    "INS": "Integrated Studies Neuro-Diverse",
    "ENG": "English",
    "MAT": "Maths",
    "SCI": "Science",
    "AHI": "Aotearoa Histories",
    "HPE": "Health & PE",
    "HEA": "Health & Wellbeing",
    "PEO": "Physical Education Outdoors",
    "PED": "Physical Education",
    "PES": "Sports And Training",
    "TGC": "Coding For Gaming",
    "TDE": "Digital Technologies",
    "DTE": "Digital Technology Environments",
    "TPD": "Product Design And Construction",
    "TBT": "Bio Technology",
    "TDV": "Architecture And Product Design",
    "TFD": "Food Around The World",
    "TTX": "Fashion And Textiles",
    "JDT": "Jewellery And Product Design",
    "CAR": "Carpentry",
    "HOS": "Hospitality",
    "PHT": "Photography",
    "ARP": "Art Painting",
    "ARD": "Art Design",
    "ART": "Visual Art",
    "MUS": "Music",
    "MUJ": "Music Jazz",
    "DAN": "Dance",
    "DRA": "Drama",
    "MPA": "Maori Performing Arts",
    "FSI": "Forensics Science",
    "SFC": "Food Chemistry",
    "SSU": "Space And Us",
    "SNS": "The Nature Of Science",
    "SCB": "Chemistry And Biology",
    "SPS": "Physics And Space Science",
    "BIO": "Biology",
    "CHE": "Chemistry",
    "PHY": "Physics",
    "ELS": "Environmental Life Science",
    "FRE": "French",
    "FRA": "French Advanced",
    "JPN": "Japanese",
    "JPA": "Japanese Advanced",
    "MDR": "Mandarin",
    "MDA": "Mandarin Advanced",
    "MAO": "Maori",
    "MAA": "Maori Advanced",
    "SAM": "Te Kura Samoan",
    "EPS": "English Proficiency Studies",
    "PWR": "Power Of The Word",
    "BUS": "Business Studies",
    "COM": "Commerce Money Talks",
    "COT": "International Travel",
    "GEO": "Geography",
    "HIS": "History",
    "CLS": "Classical Studies",
    "ECC": "Economics",
    "FIN": "Financial Capability",
    "MED": "Media Studies",
    "PSY": "Psychology",
    "TOU": "Tourism",
    "ENGA": "Sport And Society",
    "ENGB": "English And The Environment",
    "ENGC": "Maori And Pacific Voices",
    "ENGD": "Conspiracy Theories",
    "ENGF": "Dystopia",
    "ENGG": "Messages In Music",
    "ENGH": "Modern Mythic",
    "ENGJ": "NZ Culture In Film",
    "ENGK": "It's The Little Things",
    "ENGL": "What Do They Have To Say?",
    "ENGM": "Poetry Power",
    "ENGN": "Maori And Pacific Voices 2",
    "ENGQ": "Wahine Toa",
    "MAC": "Mathematics With Calculus",
    "MAS": "Mathematics With Statistics",
    "GAT": "Pathways Gateway Level",
    "PAT": "Pathways Pathways Level",
    "WTA": "Pathways Wellington Trades Academy",
    "SPEC": "Learning Support - SPEC",
    "LST": "Learning Support Transition"
};
addVariable(Document, { cookies: cookie.getAll().length });
const $window = $(window);
const $document = $(document);
const Settings = JSON.parse(cookie.get("settings") ?? "{}");
const SettingsDefault = {
    "BaseColor": "default",
    "Notifications": 1,
    "Tooltips": true,
    "DarkMode": true,
    "Buttons": {
        "GGL": true,
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
};
const file = (() => {
    // Get the full URL
    const url = window.location.href;
    // Create a URL object
    const urlObj = new URL(url);
    // Get the pathname (which includes the file name)
    const pathName = urlObj.pathname;
    // Extract the file name from the pathname
    const fileNameWithExt = pathName.split('/').pop(); // e.g. "index.html"
    const fileName = fileNameWithExt?.split('.').shift(); // e.g. "index"
    if (fileName && fileNameWithExt) {
        return {
            name: fileName,
            formattedName: fileName.charAt(0).toUpperCase() + fileName.slice(1),
            fullName: fileNameWithExt,
        };
    }
    else {
        return {
            name: null,
            formattedName: null,
            fullName: null
        };
    }
})();
export { 
//? Classes & Enums
Time, 
//? Functions
isset, addMethod, addVariable, media, redirect, reload, notification, iNotification, popup, triggerDownload, fetchData, querySelect, includeHTMLFile, 
//? Variables
classes, cookie, $document, $window, Settings, file, SettingsDefault };
