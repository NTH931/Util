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
        return __awaiter(this, arguments, void 0, function* (content, options = {}, lingers = true) {
            var _a, _b, _c, _d;
            const createdAt = new Date();
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
                left: ((_a = options.position) === null || _a === void 0 ? void 0 : _a.left) || 'auto',
                top: ((_b = options.position) === null || _b === void 0 ? void 0 : _b.top) || 'auto',
                right: ((_c = options.position) === null || _c === void 0 ? void 0 : _c.right) || '10px',
                bottom: ((_d = options.position) === null || _d === void 0 ? void 0 : _d.bottom) || '10px',
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
        return __awaiter(this, arguments, void 0, function* (content, buttons, options = {}, lingers = true) {
            var _a, _b, _c, _d;
            const createdAt = new Date();
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
                left: ((_a = options.position) === null || _a === void 0 ? void 0 : _a.left) || 'auto',
                top: ((_b = options.position) === null || _b === void 0 ? void 0 : _b.top) || 'auto',
                right: ((_c = options.position) === null || _c === void 0 ? void 0 : _c.right) || '10px',
                bottom: ((_d = options.position) === null || _d === void 0 ? void 0 : _d.bottom) || '10px',
                width: options.width || '300px',
                height: options.height || 'auto',
                overflow: 'auto',
            });
            $('.notifi-button').on({
                mouseenter: function () { $(this).css('color', '#fff'); },
                mouseleave: function () { $(this).css('color', '#888'); },
                click: function () {
                    var _a;
                    const index = $(this).data('index');
                    if (index !== undefined && ((_a = buttons[index]) === null || _a === void 0 ? void 0 : _a.buttonFunction)) {
                        $('.notifi').fadeOut(1000, function () {
                            var _a, _b;
                            (_b = (_a = buttons[index]).buttonFunction) === null || _b === void 0 ? void 0 : _b.call(_a);
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
            const createdAt = new Date();
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
export class Cookie {
    static set(name, value, daysToExpire, path = "/") {
        let expirationDate = "";
        if (daysToExpire) {
            const date = new Date();
            date.setTime(date.getTime() + (daysToExpire * 24 * 60 * 60 * 1000));
            expirationDate = "; expires=" + date.toUTCString();
        }
        document.cookie = `${name}=${encodeURIComponent(value)}${expirationDate}; path=${path}`;
    }
    // Method to get a cookie's value
    static get(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
        }
        return null;
    }
    static getAll() {
        const allCookies = [];
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            allCookies.push(cookie);
        }
        return allCookies;
    }
    // Method to delete a cookie
    static delete(name) {
        try {
            document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
            return true;
        }
        catch (_b) {
            return false;
        }
        ;
    }
    static clear() {
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
}
_a = Cookie;
// Aliases
Cookie.create = _a.set;
Cookie.construct = _a.set;
Cookie.grab = _a.get;
Cookie.pull = _a.get;
Cookie.grabAll = _a.getAll;
Cookie.pullAll = _a.getAll;
Cookie.remove = _a.delete;
Cookie.destroy = _a.delete;
Cookie.removeAll = _a.clear;
Cookie.deleteAll = _a.clear;
Cookie.destroyAll = _a.clear;
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
export function echo(...data) { console.log(...data); }
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
