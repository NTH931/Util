import * as Utils from "./utilities.js";
const { Create } = Utils;
$(function () {
    function updateClock() {
        const $clock = $("#clock");
        const currentDate = new Date();
        const hour = currentDate.getHours().toString().padStart(2, '0');
        const minute = currentDate.getMinutes().toString().padStart(2, '0');
        const seconds = currentDate.getSeconds().toString().padStart(2, '0');
        const time = `${hour}:${minute}:${seconds}`;
        const rightBefore = (targetHour, targetMinute) => {
            const targetTime = new Date(currentDate);
            targetTime.setHours(targetHour);
            targetTime.setMinutes(targetMinute - 5);
            const timeLeftMs = targetTime.getTime() - currentDate.getTime();
            const isRightBefore = currentDate >= targetTime && currentDate < new Date(targetTime.getTime() + 5 * 60000);
            const minutesLeft = Math.floor(timeLeftMs / 60000);
            const secondsLeft = Math.floor((timeLeftMs % 60000) / 1000);
            const timeLeftString = `${minutesLeft.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;
            return { isRightBefore, timeLeft: timeLeftString };
        };
        const isWeekday = (day) => {
            const currentDay = currentDate.getDay();
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
        const defautWarning = (time) => Create.popup(`You have ${time} minutes left of class`);
        let lastAlertTime;
        checkTimes.forEach(({ hour, minute, condition }) => {
            const { isRightBefore, timeLeft } = rightBefore(hour, minute);
            const currentTime = Date.now();
            if (isRightBefore && (condition === undefined || condition)) {
                if (currentTime - lastAlertTime > 60000) {
                    defautWarning(timeLeft);
                    lastAlertTime = currentTime;
                }
            }
        });
    }
    updateClock();
    setInterval(updateClock, 1000);
});
