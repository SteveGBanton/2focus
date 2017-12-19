
/*
  Define document objects
 */
const timerLineBar = document.getElementById("index-countdown-line-bar");

const startButton = document.getElementById("start-button");

const stopButton = document.getElementById("stop-button");

const resetButton = document.getElementById("reset-button");

const displayClock = document.getElementById("input2");

const add0Button = document.getElementById("add-0");
const add10sButton = document.getElementById("add-10s");
const add30sButton = document.getElementById("add-30s");
const add1mButton = document.getElementById("add-1m");
const add5mButton = document.getElementById("add-5m");
const add10mButton = document.getElementById("add-10m");
const add30mButton = document.getElementById("add-30m");
const add1hButton = document.getElementById("add-1h");

// TODO add get elements by class - make all add time buttons disabled when 

/*
  Set initial timer variables
 */
let timer = null; // Will be set to timer setInterval object
let countdownTimer = null;
let countdownValue = 10000;
let interval = 10; // Interval to which to refresh timer in ms
let value = 60000; // Current timer value in JS
let originalLength = 60000; // Length at which to reset to - changed by user, stored as state
timerLineBar.setAttribute('style', 'width: 100%;'); // Set the bar to 100%
displayClock.value = computeDisplayValue(originalLength);

/*
  Add listeners to start, stop, reset buttons and input (time display) field
 */
startButton.addEventListener("click", startHandler);

stopButton.addEventListener("click", stopHandler);

resetButton.addEventListener("click", function () {
  displayClock.value = computeDisplayValue(originalLength);
  value = originalLength;
  clearInterval(timer);
  timer = null;
  timerLineBar.setAttribute('style', 'width: 100%;');
});

add0Button.addEventListener("click", function () {
  if (timer === null && countdownTimer === null) {
    originalLength = 0;
    value = originalLength
    displayClock.value = computeDisplayValue(value);
    resetButton.value = `reset@${computeDisplayValue(value)}`
  }
});

add10sButton.addEventListener("click", () => addTime(10000));

add30sButton.addEventListener("click", () => addTime(30000));

add1mButton.addEventListener("click", () => addTime(60000));

add5mButton.addEventListener("click", () => addTime(300000));

add10mButton.addEventListener("click", () => addTime(600000));

add30mButton.addEventListener("click", () => addTime(1800000));

add1hButton.addEventListener("click", () => addTime(3600000))

function addTime(time) {
  if (timer === null && countdownTimer === null) {
    originalLength = originalLength + time;
    value = originalLength
    displayClock.value = computeDisplayValue(value);
    resetButton.value = `reset@${computeDisplayValue(value)}`;
  }
}

/*
  Page Visibility API to detect if page is focused.
 */
var hidden, visibilityChange;
if (typeof document.hidden !== "undefined") { // Opera 12.10 and Firefox 18 and later support 
  hidden = "hidden";
  visibilityChange = "visibilitychange";
} else if (typeof document.msHidden !== "undefined") {
  hidden = "msHidden";
  visibilityChange = "msvisibilitychange";
} else if (typeof document.webkitHidden !== "undefined") {
  hidden = "webkitHidden";
  visibilityChange = "webkitvisibilitychange";
}

/*
  Warn if the browser doesn't support addEventListener or the Page Visibility API
 */
if (typeof document.addEventListener === "undefined" || typeof document.hidden === "undefined") {
  console.log("This site requires a modern browser that supports the Page Visibility API.");
  value = null;
} else {
  // Handle page visibility change   
  document.addEventListener(visibilityChange, handleVisibilityChange, false);
}

function startHandler() {
  if (timer !== null || value <= 0) return;
  resetButton.disabled = true;
  startButton.disabled = true;
  stopButton.disabled = false;

  timerLineBar.style['background-color'] = 'lightcoral';
  displayClock.style.color = 'lightcoral';

  countdownTimer = setInterval(() => {
    if (countdownValue < 0) {
      console.log('startTimer');
      clearCountdownTimer();
      startTimer();
    } else {
      countdownValue = countdownValue - 100;
      displayClock.value = computeDisplayValue(countdownValue);
      timerLineBar.style.width = `${countdownValue / 10000 * 100}%`;
    }
  }, 100)
}

function startTimer() {
  timerLineBar.setAttribute('style', 'background-color: lightblue;');
  displayClock.style.color = 'rgb(85, 85, 85)';

  timer = setInterval(function () {
    if (value === 0) {
      // TODO Successful countdown. Fire route to log successful session.
      logSession(true, originalLength, 0);
      value = -1;
      displayClock.value = "00:00:00";
      stopHandler();
    } else if (value < 0) {
      value = -1;
      stopHandler();
      displayClock.value = "00:00:00";
    } else {
      // Countdown condition
      value = value - 10;
      displayClock.value = computeDisplayValue(value);
      const widthSet = `width: ${value / originalLength * 100}%;`;
      timerLineBar.setAttribute('style', widthSet);
    }
  }, interval);
}

// Ends & Logs session when timer is active and user focuses on a different window.
function handleVisibilityChange() {
  if (document.hidden && timer !== null && value > 0 && value < originalLength) {
    displayClock.value = '00:00:00';
    logSession(false, originalLength, value);
    clearCountdownTimer();
    clearTimer();
  } else if (document.hidden && timer === null && countdownTimer !== null)
    displayClock.value = '00:00:00';
    clearCountdownTimer();
}

// Ends & Logs session when timer is active and user clicks stop.
function stopHandler() {
  if (timer !== null && value > 0 && value < originalLength) {
    logSession(false, originalLength, value);
  }
  resetButton.disabled = false;
  stopButton.disabled = true;
  startButton.disabled = false;
  clearCountdownTimer();
  clearTimer();
  displayClock.value = '00:00:00';
  timerLineBar.style.width = '100%';
  timerLineBar.style['background-color'] = 'lightblue';
  displayClock.style.color = 'rgb(85, 85, 85)';
}

// Ends & Logs session when user unloads the window / navigates away.
window.onunload = function() {
  if (timer !== null && value > 0 && value < originalLength) {
    displayClock.value = '00:00:00';
    logSession(false, originalLength, value);
    clearCountdownTimer();
    clearTimer();
  }
}

function logSession(wasSuccess, length, stopPoint) {
  console.log('logging' + wasSuccess + length)
  const submission = {
    'target_length': length,
    'focused_length': length - stopPoint,
    'success': wasSuccess,
  }
  postToDB(submission);
}

function postToDB(submission) {
  axios.post('api/timer-sessions', submission)
    .then((res) => {
      // console.log(res);
    })
    .catch((err) => console.error(err));
}

function clearTimer() {
  if (timer !== null) {
    clearInterval(timer);
    timer = null;
    value = -1;
  }
}

function clearCountdownTimer() {
  if (countdownTimer !== null) {
    clearInterval(countdownTimer);
    countdownTimer = null;
    countdownValue = 10000;
  }
}

function computeDisplayValue(milliseconds) {

  const seconds = Math.round(milliseconds / 1000);
  let displaySeconds = seconds % 60;
  const minutes = (seconds - displaySeconds) / 60;
  let displayMinutes = minutes % 60;
  let displayHours = (minutes - displayMinutes) / 60;

  if (displaySeconds < 10 && displaySeconds > 0) {
    displaySeconds = `0${displaySeconds}`;
  } else if (displaySeconds === 0) {
    displaySeconds = "00";
  } else {
    displaySeconds = `${displaySeconds}`
  }

  if (displayMinutes < 10 && displayMinutes > 0) {
    displayMinutes = `0${displayMinutes}`;
  } else if (displayMinutes === 0) {
    displayMinutes = "00";
  } else {
    displayMinutes = `${displayMinutes}`
  }

  if (displayHours < 10 && displayHours > 0) {
    displayHours = `0${displayHours}`;
  } else if (displayHours === 0) {
    displayHours = "00";
  } else {
    displayHours = `${displayHours}`
  }

  return `${displayHours}:${displayMinutes}:${displaySeconds}`;
}
