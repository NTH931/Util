var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var _a;
export class Create {
    static notification(content_1) {
        return __awaiter(this, arguments, void 0, function* (content, importance = false, options = {}, lingers = true) {
            var _a, _b, _c, _d, _e, _f;
            if ((importance ? 2 : 1) < ((_b = JSON.parse((_a = Cookie.get("settings")) !== null && _a !== void 0 ? _a : "")) === null || _b === void 0 ? void 0 : _b.Notifications))
                return;
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
                left: ((_c = options.position) === null || _c === void 0 ? void 0 : _c.left) || 'auto',
                top: ((_d = options.position) === null || _d === void 0 ? void 0 : _d.top) || 'auto',
                right: ((_e = options.position) === null || _e === void 0 ? void 0 : _e.right) || '10px',
                bottom: ((_f = options.position) === null || _f === void 0 ? void 0 : _f.bottom) || '10px',
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
        });
    }
    static iNotification(content_1, buttons_1) {
        return __awaiter(this, arguments, void 0, function* (content, buttons, importance = true, options = {}, lingers = true) {
            var _a, _b, _c, _d, _e, _f;
            if ((importance ? 2 : 1) < ((_b = JSON.parse((_a = Cookie.get("settings")) !== null && _a !== void 0 ? _a : "")) === null || _b === void 0 ? void 0 : _b.Notifications))
                return;
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
                left: ((_c = options.position) === null || _c === void 0 ? void 0 : _c.left) || 'auto',
                top: ((_d = options.position) === null || _d === void 0 ? void 0 : _d.top) || 'auto',
                right: ((_e = options.position) === null || _e === void 0 ? void 0 : _e.right) || '10px',
                bottom: ((_f = options.position) === null || _f === void 0 ? void 0 : _f.bottom) || '10px',
                width: options.width || '300px',
                height: options.height || 'auto',
                overflow: 'auto',
            });
            $('.notifi-button').on({
                mouseenter: function () { $(this).css('color', '#fff'); },
                mouseleave: function () { $(this).css('color', '#888'); },
                click: function () {
                    var _a, _b, _c;
                    const index = $(this).data('index');
                    if (index !== undefined && ((_a = buttons[index]) === null || _a === void 0 ? void 0 : _a.buttonFunction)) {
                        (_c = (_b = buttons[index]).buttonFunction) === null || _c === void 0 ? void 0 : _c.call(_b);
                        $('.notifi').fadeOut(1000, function () {
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
        });
    }
    static popup(message_1) {
        return __awaiter(this, arguments, void 0, function* (message, options = {}
        // @ts-ignore
        ) {
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
        });
    }
    ;
}
export class Storage {
}
_a = Storage;
Storage.localStorage = {
    get(key) {
        return localStorage.getItem(key);
    },
    set(key, value) {
        try {
            localStorage.setItem(key, value.toString());
            return true;
        }
        catch (_b) {
            return false;
        }
    },
    remove(key) {
        try {
            localStorage.removeItem(key);
            return true;
        }
        catch (_b) {
            return false;
        }
    },
    clear() {
        try {
            localStorage.clear();
            return true;
        }
        catch (_b) {
            return false;
        }
    }
};
// Method to get a cookie's value
Storage.cookie = {
    set(name, value, daysToExpire, path = "/") {
        let expirationDate = "";
        if (daysToExpire) {
            const date = new Date();
            date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
            expirationDate = "; expires=" + date.toUTCString();
        }
        document.cookie = `${name}=${encodeURIComponent(value)}${expirationDate}; path=${path}`;
    },
    get(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
        }
        return null;
    },
    getAll() {
        const allCookies = [];
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            allCookies.push(cookie);
        }
        return allCookies;
    },
    // Method to delete a cookie
    delete(name) {
        try {
            document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            return true;
        }
        catch (_b) {
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
        catch (_b) {
            return false;
        }
    }
};
// Aliases
Storage.create = _a.cookie.set;
Storage.construct = _a.cookie.set;
Storage.grab = _a.cookie.get;
Storage.pull = _a.cookie.get;
Storage.grabAll = _a.cookie.getAll;
Storage.pullAll = _a.cookie.getAll;
Storage.remove = _a.cookie.delete;
Storage.destroy = _a.cookie.delete;
Storage.removeAll = _a.cookie.clear;
Storage.deleteAll = _a.cookie.clear;
Storage.setItem = _a.localStorage.set;
Storage.getItem = _a.localStorage.get;
Storage.removeItem = _a.localStorage.remove;
/** Constructs date objects up to the hour */
export class Time {
    constructor(hours, minutes, seconds, milliseconds) {
        this.date = new Date();
        this.hours = hours !== null && hours !== void 0 ? hours : this.date.getHours();
        this.minutes = minutes !== null && minutes !== void 0 ? minutes : this.date.getMinutes();
        this.seconds = seconds !== null && seconds !== void 0 ? seconds : this.date.getSeconds();
        this.milliseconds = milliseconds !== null && milliseconds !== void 0 ? milliseconds : this.date.getMilliseconds();
        if (hours !== undefined && (hours < 0 || hours >= 24))
            throw new Error("Hours must be between 0 and 23.");
        if (minutes !== undefined && (minutes < 0 || minutes >= 60))
            throw new Error("Minutes must be between 0 and 59.");
        if (seconds !== undefined && (seconds < 0 || seconds >= 60))
            throw new Error("Seconds must be between 0 and 59.");
        if (milliseconds !== undefined && (milliseconds < 0 || milliseconds >= 1000))
            throw new Error("Milliseconds must be between 0 and 999.");
    }
    setHours(hours) {
        if (hours < 0 || hours >= 24) {
            throw new Error("Hours must be between 0 and 23.");
        }
        this.hours = hours;
    }
    setMinutes(minutes) {
        if (minutes < 0 || minutes >= 60) {
            throw new Error("Minutes must be between 0 and 59.");
        }
        this.minutes = minutes;
    }
    // Additional setters
    setSeconds(seconds) {
        if (seconds < 0 || seconds >= 60) {
            throw new Error("Seconds must be between 0 and 59.");
        }
        this.seconds = seconds;
    }
    setMilliseconds(milliseconds) {
        if (milliseconds < 0 || milliseconds >= 1000) {
            throw new Error("Milliseconds must be between 0 and 999.");
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
export function readFile(file) {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const response = yield fetch(file);
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const text = yield response.text();
            return text;
        }
        catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
            return null;
        }
    });
}
export function protoMethod(Class, methodDefinition, options = { enumerable: false }) {
    var _b;
    if (typeof Class !== 'object' && typeof Class !== 'function') {
        throw new TypeError('First argument must be an object or function');
    }
    if (typeof methodDefinition !== 'function' && typeof methodDefinition !== 'object') {
        throw new TypeError('Second argument must be a function or property descriptor');
    }
    const methodName = typeof methodDefinition === 'function' ? methodDefinition.name : (_b = methodDefinition.value) === null || _b === void 0 ? void 0 : _b.name;
    if (typeof Class === 'function') {
        try {
            Object.defineProperty(Class.prototype, methodName, Object.assign({ value: methodDefinition }, options));
            return [true, null];
        }
        catch (error) {
            return [false, error];
        }
    }
    else if (typeof Class === 'object') {
        try {
            if (typeof methodDefinition === 'function') {
                Class[methodName] = methodDefinition;
            }
            else {
                Object.defineProperty(Class, methodName, methodDefinition);
            }
            return [true, null];
        }
        catch (error) {
            return [false, error];
        }
    }
    else {
        throw new TypeError('Invalid type for first argument');
    }
}
export function media(rule, value) {
    const mediaQueryString = `(${rule}: ${value})`;
    return window.matchMedia(mediaQueryString).matches;
}
export function log(...data) { console.log(...data); }
export const classes = {
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
export const LocalStorage = Storage.localStorage;
export const Cookie = Storage.cookie;
