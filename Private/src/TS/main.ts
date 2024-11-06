import * as utils from './utilities.js';
const { Time, redirect, popup, file, Settings, Codes, cookie } = utils;

document.bindShortcut("ctrl+s", (e) => e.preventDefault());

//= Redirects If the Title is clicked
$("#title").on("click", () => redirect("index.html"));

// Redirects if the "page_visited" Cookie is set
$(() => {
  if (!cookie.get("page_visited")) {
    cookie.set("page_visited", true);
    redirect("index.html");
  }
});

// input[type=search]
$(() => {
  $("input[type=search]").each(function() {
    const contentId = $(this).attr("search-content")?.toString();
    if (contentId) {
      const container = $("#" + contentId);
      // Store the original HTML content
      container.data("original-html", container.html());
    }
  });

  $("input[type=search]").on("input", function() {
    const $this = $(this);
    const searchText = ($this.val() as string) || "";
    const searchTextLower = searchText.toLowerCase() || "";
    const elementsSelector = $this.attr("elements") || "*";
    const contentId = $this.attr("search-content")?.toString();

    if (!contentId) return;
    const container = $("#" + contentId);
    container.html(container.data("original-html"));

    if (searchTextLower === "") {
      // Restore original HTML content if search text is empty
      container.html(container.data("original-html"));
      return;
    }

    const elements = container.find(elementsSelector);

    const caseMatch: JQuery<HTMLElement>[] = [];
    const startsWithElements: JQuery<HTMLElement>[] = [];
    const containsElements: JQuery<HTMLElement>[] = [];

    elements.each(function() {
      const elementText = $(this).clone().text().trim().toLowerCase();

      if (elementText.startsWith(searchText)) {
        caseMatch.push($(this));
      } else if (elementText.startsWith(searchTextLower)) {
        startsWithElements.push($(this));
      } else if (elementText.includes(searchTextLower)) {
        containsElements.push($(this));
      }
    });

    // Combine both lists with startsWithElements first
    const filteredElements = [
      ...caseMatch,
      ...startsWithElements,
      ...containsElements
    ];

    // Hide all elements initially
    elements.addClass("hidden");

    // Show and append filtered elements back to the container
    container.empty();
    filteredElements.forEach(item => {
      item.removeClass("hidden");
      container.append(item);
    });
  });
});

// Clock
$(() => {
  function updateClock() {
    const $clock = $("#clock");

    const currentTime = new Time();
    const hour = currentTime.getHours().toString().padStart(2, '0');
    const minute = currentTime.getMinutes().toString().padStart(2, '0');
    const seconds = currentTime.getSeconds().toString().padStart(2, '0');
    const time = `${hour}:${minute}:${seconds}`;

    const rightBefore = (targetHour: number, targetMinute: number): {isRightBefore: boolean, timeLeft: string} => {
      const targetTime = new Time(targetHour, targetMinute - 5);

      const currentTotalMinutes = currentTime.getHours() * 60 + currentTime.getMinutes();
      const targetTotalMinutes = targetTime.getHours() * 60 + targetTime.getMinutes();
      const timeLeftMinutes = targetTotalMinutes - currentTotalMinutes;
      const isRightBefore = timeLeftMinutes >= 0 && timeLeftMinutes < 5;

      const minutesLeft = Math.floor(timeLeftMinutes);
      const secondsLeft = Math.floor((300000 - (currentTime.getTime() % 60000)) / 1000);

      const timeLeftString = `${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;

      return { isRightBefore, timeLeft: timeLeftString };
    };

    const isWeekday = (day: number): boolean => {
      const currentDay = new Date().getDay();
      return currentDay === day && day >= 1 && day <= 5;
    };

    $clock.text(time);
    $clock.css("font-family", '"Courier New", Courier, monospace');

    const patternA = isWeekday(1) || isWeekday(3) || isWeekday(5);
    const patternB = isWeekday(2) || isWeekday(4);

    const checkTimes = [
      { hour: 8, minute: 50 },
      { hour: 2, minute: 24 },
      { hour: 11, minute: 50, condition: patternA },
      { hour: 13, minute: 55, condition: patternA },
      { hour: 11, minute: 5, condition: patternB },
      { hour: 13, minute: 5, condition: patternB },
    ];

    const defautWarning = (time: string) => popup(`You have ${time} minutes left of class`);
    let lastAlertTime: number;

    /*checkTimes.forEach(({ hour, minute, condition }) => {
      const { isRightBefore, timeLeft } = rightBefore(hour, minute);
      const currentTimeMillis = currentTime.getTime();
  
      if (isRightBefore && (condition === undefined || condition)) {
          if (currentTimeMillis - (lastAlertTime || 0) > 60000) {
              defautWarning(timeLeft);
              lastAlertTime = currentTimeMillis;
          }
      }
    });*/
  }

  updateClock();
  setInterval(updateClock, 1000);
});