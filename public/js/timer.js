
// Timer variables
let timer = null;
let interval = 10;
let value = document.getElementById("input2").value * 1000;
let originalLength = value;

document.getElementById("start-button").addEventListener("click", startHandler);

document.getElementById("stop-button").addEventListener("click", stopHandler);

document.getElementById("reset-button").addEventListener("click", function () {
  document.getElementById("input2").value = originalLength / 1000;
  value = originalLength;
  clearInterval(timer);
  timer = null;
});

document.getElementById("input2").addEventListener("input", function () {
  value = document.getElementById("input2").value * 1000;
  originalLength = Math.round(value);
  document.getElementById("input2").value = Math.round(document.getElementById("input2").value) * 1;
});

// Page Visibility API to detect if page is focused.
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

function handleVisibilityChange() {
  if (document.hidden && timer !== null) {
    console.log('left');
    // TODO fire route to create DB session fail.
    logSession(false, originalLength, value);
    value = -1;
    document.getElementById("input2").value = '0';
  }
}

// Warn if the browser doesn't support addEventListener or the Page Visibility API
if (typeof document.addEventListener === "undefined" || typeof document.hidden === "undefined") {
  console.log("This site requires a modern browser that supports the Page Visibility API.");
  value = null;
} else {
  // Handle page visibility change   
  document.addEventListener(visibilityChange, handleVisibilityChange, false);
}

function startHandler() {
  if (timer !== null) return;
  if (value > 0) {
    document.getElementById("stop-button").value = 'stop (fail session!)';
    document.getElementById("input2").disabled = true;
    document.getElementById("reset-button").disabled = true;
    document.getElementById("start-button").disabled = true;
  }

  timer = setInterval(function () {
    if (value === 0) {
      // TODO Successful countdown. Fire route to log successful session.
      logSession(true, originalLength, 0);
      value = -1;
      document.getElementById("input2").value = 0;
    } else if (value < 0) {
      value = -1;
      stopHandler();
      document.getElementById("input2").value = 0;
    } else {
      value = value - 10;
      document.getElementById("input2").value = value / 1000;
    }
  }, interval);
}

function stopHandler() {
  console.log('stop')
  if (timer !== null && value > 0 && value < originalLength) {
    logSession(false, originalLength, value);
  }
  document.getElementById("input2").disabled = false;
  document.getElementById("reset-button").disabled = false;
  document.getElementById("stop-button").value = 'stop';
  document.getElementById("stop-button").disabled = false;
  document.getElementById("start-button").disabled = false;
  clearInterval(timer);
  timer = null;
  value = -1;
  document.getElementById("input2").value = 0;
}

function logSession(wasSuccess, length, stopPoint) {
  if (wasSuccess === false) {
    console.log('failure!! ' + stopPoint + ' of ' + length)
  } else {
    console.log('success!! ' + stopPoint + ' of ' + length)
  }
}

console.log('timer script loaded1')
