var time;
var addedMinutes = 0; // Initialize addedMinutes

function timeCalculate() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      var obj = JSON.parse(t);

      time = obj["time"];
    }
  };

  r.open("GET", "timeProcess.php", true);
  r.send();
}

function updateTargetDate() {
  // Parse the current target date
  const targetDate = new Date(time);

  // Add 3 minutes to the current target date
  targetDate.setMinutes(targetDate.getMinutes() + 3);

  // Store the updated target date
  time = targetDate.toISOString();
}

var time;

// Variable to track if the session has already been executed
var sessionExecuted = false;

// Update the countdown every second
const countdownInterval = setInterval(function () {
  timeCalculate();

  // Set the target date and time for the countdown (replace with your desired date and time)
  const targetDate = new Date(time).getTime();

  // Get the current date and time
  const currentDate = new Date().getTime();

  // Calculate the time remaining in milliseconds
  const timeRemaining = targetDate - currentDate;

  // Calculate minutes and seconds from milliseconds
  const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

  // Ensure hours and minutes are two digits with leading zeros
  const formattedMinutes = String(minutes).padStart(2, "0");
  const formattedSeconds = String(seconds).padStart(2, "0");

  // Display the countdown in the "countdown" div
  const countdownElement = document.getElementById("countdown");
  countdownElement.innerHTML = `${formattedMinutes}:${formattedSeconds}`;

  // Check if the countdown has reached zero and the session hasn't been executed
  if (timeRemaining <= 0 && !sessionExecuted) {
    countdownElement.innerHTML = "GOODLUCK";

    sessionExecuted = true;

    countdownElement.innerHTML = "GOODLUCK";

    updateTargetDate();
    loadAPBetTableData();

    setTimeout(startCountdown, 1000);
  } else if (timeRemaining > 0) {
    // Reset sessionExecuted when the countdown is running
    sessionExecuted = false;

    // Check if there are less than or equal to 30 minutes remaining
    if (timeRemaining <= 15000) {
      const yourButton = document.getElementById("investBtn");
      if (yourButton.disabled) {
        yourButton.disabled = false;
      }
    } else {
      document.getElementById("investBtn").disabled = true;
    }
  }
}, 1000);

// Get all number buttons
const numberButtons = document.querySelectorAll('.number-button');
let selectedNumber = null;

// Add a click event listener to each number button
numberButtons.forEach(button => {
  button.addEventListener('click', () => {
    // Remove the 'selected' class from all buttons
    numberButtons.forEach(btn => btn.classList.remove('selected'));
    
    // Add the 'selected' class to the clicked button
    button.classList.add('selected');
    
    // Get the selected number's value from the 'data-value' attribute
    selectedNumber = button.getAttribute('data-value');
    
    // alert(selectedNumber);
  });
});

function loadAPBetTableData() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      document.getElementById("APBetsTable").innerHTML = t;
    }
  };

  r.open("POST", "APBetTableProcess.php", true);
  r.send();
}
setInterval(loadAPBetTableData, 1000);

function updateAPBetsDetails() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      document.getElementById("betDetails").innerHTML = t;
    }
  };

  r.open("POST", "updateAPBetsDetailsProcess.php", true);
  r.send();
}
setInterval(updateAPBetsDetails, 1000);

function redirectToBetsDetails(id){
  
  window.location = "APBetsDetails.php?sid="+id;

}

function changeBetCount(){

  var betCount = document.getElementById("betCount").value;

  const toastLiveExample = document.getElementById('liveToast');
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      
      toastBootstrap.show();

    }
  };

  r.open("GET","changeBetCountProcess.php?b="+betCount,true);
  r.send();

}

function updateSessionId(){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      
      document.getElementById("usid").innerHTML = t;
    }
  };

  r.open("GET", "updateSessionIdProcess.php", true);
  r.send();

}
setInterval(updateSessionId, 1000);

function customResult(){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
    }
  };

  r.open("GET", "customResultProcess.php?n="+selectedNumber, true);
  r.send();

}


function changeUserStatus(email){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }

    } 
  }

  r.open("GET","changeUserStatusProcess.php?e="+email,true);
  r.send();

}

function changeWalletBalance(email){

  var balance = document.getElementById("balance" + email).value;

  var f = new FormData();
  f.append("balance", balance);
  f.append("email", email);

  var result = confirm("Are you sure you want to proceed?");

  if (result === true) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
        var t = r.responseText;
        
        if(t == "Success"){
          window.location.reload();
        }else{
          alert(t);
        }

      }
    }

    r.open("POST","changeWalletBalanceProcess.php",true);
    r.send(f);
  }else{
    window.location.reload();
  }

}

function findusers(){

  var keyword = document.getElementById("text").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      document.getElementById("loadusers").innerHTML = t;
      // alert(t);

    } 
  }

  r.open("GET","searchUsersProcess.php?k="+keyword,true);
  r.send();

}

function redirectToBetsDetails(id){
  
  window.location = "APBetsDetails.php?sid="+id;

}