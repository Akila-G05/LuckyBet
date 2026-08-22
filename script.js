// Tabbed Pane
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-red";
}

// BTC/USDT Live Price
var btcusdtPrice;

function fetchBTCPrice() {
  // Define the URL for fetching the BTC/USDT price from Binance API
  const apiUrl = "https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT";

  // Make a GET request to Binance API
  fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      btcusdtPrice = parseFloat(data.price);

      // Extract the last character (the last digit)
      const lastCharacter = btcusdtPrice.toFixed(2).slice(0, -1);

      // Display the live BTC/USDT price with the last character in a different color
      const priceContainer = document.getElementById("price-container");
      priceContainer.innerHTML = `${btcusdtPrice
        .toFixed(2)
        .replace(
          lastCharacter,
          `<span style="color: #ffc107;">${lastCharacter}</span>`
        )} `;
    })
    .catch((error) => {
      console.error("Error fetching BTC/USDT price:", error);
    });
}

// Fetch and update the BTC price every 10 seconds
setInterval(fetchBTCPrice, 1000); // 10,000 milliseconds = 10 seconds

function invest() {
  alert(btcusdtPrice);
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

var time;
var addedMinutes = 0; // Initialize addedMinutes
var nowtime;

function timeCalculate() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      var obj = JSON.parse(t);

      time = obj["time"];
      nowtime = obj["time2"];
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

  var date2 = document.getElementById("date2").value;

  // Get the current date and time
  const currentDate = new Date(nowtime).getTime();

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
    // session();

    countdownElement.innerHTML = "GOODLUCK";

    updateTargetDate();
    // setTimeout(getResult, 1000);

    setTimeout(startCountdown, 1000);
  } else if (timeRemaining > 0) {
    // Reset sessionExecuted when the countdown is running
    sessionExecuted = false;

    // Check if there are less than or equal to 30 minutes remaining
    if (timeRemaining <= 30000) {
      const yourButton = document.getElementById("investBtn");
      const yourButton2 = document.getElementById("investBtn2");
      const yourButton3 = document.getElementById("investBtn3");
      if (!yourButton.disabled) {
        yourButton.disabled = true;
      }
      if (!yourButton2.disabled) {
        yourButton2.disabled = true;
      }
      if (!yourButton3.disabled) {
        yourButton2.disabled = true;
      }
    } else {
      document.getElementById("investBtn").disabled = false;
      document.getElementById("investBtn2").disabled = false;
      document.getElementById("investBtn3").disabled = false;
    }
  }

  
  
}, 1000);

setInterval(getResult, 1000);
setInterval(refreshBetHistory, 1000);
setInterval(refreshHistory, 1000);

// function session() {

//   var r = new XMLHttpRequest();

//   var f = new FormData();
//   f.append("btc", btcusdtPrice);

//   r.onreadystatechange = function () {
//     if (r.readyState == 4 && r.status == 200) {
//       var t = r.responseText;
//       // alert(t)
//       document.getElementById("usid").innerHTML = t;

//     }
//   };

//   r.open("POST", "loop.php", true);
//   r.send(f);
// }

function refreshHistory() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;

      document.getElementById("history").innerHTML = t;
    }
  };

  r.open("GET", "loadMoreHistoryProcess.php", true);
  r.send();
}

function loadHistory() {
  var more = 10;
  more = +10;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      alert(t);
    }
  };

  r.open("GET", "loadMoreHistoryProcess.php?more=" + more, true);
  r.send();
}

var totalWBalance;
function updateWalletBalance(){
  
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("wBalance").innerHTML = "$ " + t;

      totalWBalance = t;

    }
  };

  r.open("GET", "updateBalanceProcess.php", true);
  r.send();

}

setInterval(updateWalletBalance, 1000);

function colorModal(id) {
  // Find the radio input element by its ID and set it to checked
  document.getElementById(id).checked = true;

  var CModal = new bootstrap.Modal(document.getElementById('colourModal'));
  CModal.show();

}



selectedNumber;
function numberModal(value) {

  selectedNumber = value;

  var NModal = new bootstrap.Modal(document.getElementById('numberModal'));
  NModal.show();

}


function refreshBetHistory() {

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      document.getElementById("betsHistory").innerHTML = t;
    }
  };

  r.open("GET", "loadBetsHistoryProcess.php", true);
  r.send();
}



function setPrice(balance){

  var inputElement = document.getElementById("price");

  // Get the value and round it to the nearest integer
  const inputValue = Math.round(Number(inputElement.value));


  // if(inputValue > balance){
  //   inputElement.value = balance;
  // }else{
  //   inputElement.value = inputValue;
  // }

}

function setPrice2(balance){

  var inputElement = document.getElementById("price2");

  // Get the value and round it to the nearest integer
  const inputValue = Math.round(Number(inputElement.value));

  // if(inputValue > balance){
  //   inputElement.value = balance;
  // }else{
  //   inputElement.value = inputValue;
  // }


}

// function showToast() {
//   var toast = new bootstrap.Toast(document.getElementById("myToast"));
//   toast.show();
// }



function joinColor() {

  const radioButtons = document.getElementsByName("inlineRadioOptions");
  var price = document.getElementById("price");

  if(price.value > totalWBalance){
    alert("Insuficient Wallet Ballance")
  }else{
  
    var CModal = new bootstrap.Modal(document.getElementById('colourModal'));

    let selectedValue = "";

    for (const radioButton of radioButtons) {
        if (radioButton.checked) {
            selectedValue = radioButton.value;
            break; 
        }
    }

    var f = new FormData();
    f.append("color", selectedValue);
    f.append("price", price.value);

    var  r = new XMLHttpRequest();

    r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
        var t = r.responseText;

        if(t == "Success"){
          // window.location.reload();
          alert("Success")
          CModal.hide();
        }else{
          alert(t);
        }

      }
    }
    
    r.open("POST", "joinColorProcess.php", true);
    r.send(f);
  }

}

function joinNumber() {

  var price = document.getElementById("price2");

  var f = new FormData();
  f.append("price", price.value);
  f.append("number", selectedNumber);

  if(price.value > totalWBalance){
    alert("Insuficient Wallet Ballance")
  }else{
    
    var  r = new XMLHttpRequest();

    r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
        var t = r.responseText;

        if(t == "Success"){
          // window.location.reload();
          alert("Success");
        }else{
          alert(t);
        }

      }
    }
    
    r.open("POST", "joinNumberProcess.php", true);
    r.send(f);
  }

}

function getResult(){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;

    }
  }

  r.open("POST", "getResultProcess.php", true);
  r.send();

}

function signup(){

  var email = document.getElementById("email").value;
  var pw = document.getElementById("pw").value;
  var mobile = document.getElementById("mobile").value;
  var code = document.getElementById("r_code").value;
  

  var f = new FormData();
  f.append("e", email);
  f.append("pw", pw);
  f.append("m", mobile);
  f.append("rc", code);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location = "signin.php"
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","signupProcess.php",true);
  r.send(f);

}

function signin(){

  var email = document.getElementById("email");
  var password = document.getElementById("pw");

  var r = new XMLHttpRequest();

  var f = new FormData();
  f.append("e",email.value);
  f.append("p",password.value);

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;

      if(t == "Success"){
        window.location = "index.php";
      }else if(t == "Success2"){
        window.location= "index.php";
      }else if(t == "Success3"){
        var m = document.getElementById("adminSigninModel");
        bm = new bootstrap.Modal(m);
        bm.show();
        // window.location = "adminPannel.php"; 
      }else{
        alert(t);
      }

    }
  };

  r.open("POST","signInProcess.php",true);
  r.send(f);

}

function verifyAdmin(){

  var vc = document.getElementById("vc").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location = "adminPannel.php";
      }else{
        alert(t);
      }

    }
  }

  r.open("GET","verifyAdminProcess.php?vc="+vc,true);
  r.send();
  
}

var fm;
function forgotPw(){
    
  var email = document.getElementById("email").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
          var t = r.responseText;
          if(t == "Success"){
              var m = document.getElementById("forgotPasswordModal");
              bm = new bootstrap.Modal(m);
              bm.show();
          }else{
              document.getElementById("msg2").innerHTML=t;
              document.getElementById("msgdiv2").className="d-block";;
          }
      }
  }

  r.open("GET","forgotPasswordProcess.php?e="+email,true);
  r.send();

}

function resetpw(){

  var email = document.getElementById("email");
  var np = document.getElementById("npi");
  var rnp = document.getElementById("rnp");
  var vcode = document.getElementById("vc");

  var f = new FormData();
  f.append("e",email.value);
  f.append("n",np.value);
  f.append("r",rnp.value);
  f.append("v",vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "success"){

          bm.hide();
          alert("Password reset Success");

      }else{
          alert(t);
      }
    }
  }

  r.open("POST","resetPasswordProcess.php",true);
  r.send(f);

} 

var NModal;
function openCNModal() {

  NModal = new bootstrap.Modal(document.getElementById('nameModal'));
  NModal.show();

}

function changeuserName(){

  var userName = document.getElementById("un").value;

  var f = new FormData();
  f.append("userName", userName);

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

  r.open("POST","changeUsernameProcess.php",true);
  r.send(f);

}

var WModal;
function openWModal() {
  WModal = new bootstrap.Modal(document.getElementById('withdrawModal'));
  WModal.show();

}





//Coin Payments
//wallet

function getDepositAddress() {

  var DModal = new bootstrap.Modal(document.getElementById('depositModal'));
  DModal.show();
  // alert("Ok");
  var cmd = "get_deposit_address";//don't change
  var currency = "LTCT"; //The currency the buyer will be sending.

  var form = new FormData();
  form.append("cmd", cmd);
  form.append("currency", currency);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var table = document.getElementById("dAddress");
      var t = request.responseText;
      DModal.show();
      // alert(t);

      table.innerHTML = t;

    }
  };

  request.open("POST", "./backend/getDepositAddress.php", true);
  request.send(form);
}

function createWithdrawal() {
  var cmd = "create_withdrawal"; //don't change
  var amount = Math.round(Number(document.getElementById("priceW").value)); //The amount of the withdrawal in the currency below./Required
  var address = document.getElementById("wAddress").value; //The address to send the funds to, either this OR pbntag must be specified.Remember: this must be an address in currency's network.
  var currency = "LTCT"; //The cryptocurrency to withdraw. (BTC, LTC, etc.)/Required
  var auto_confirm = "1"; //if this is 1 this can complete without email confirmation

  var form = new FormData();
  form.append("cmd", cmd);
  form.append("currency", currency);
  form.append("address", address);
  // form.append("domain", domain);
  form.append("amount", amount);
  form.append("auto_confirm", auto_confirm);

  if(amount > totalWBalance){
    alert("insufficient Wallet Balance");
  }else{
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        alert(request.responseText);
        var table = document.getElementById("table");
        var t = request.responseText;
        alert(t);

        table.innerHTML = t;
      }
    };

    request.open("POST", "./backend/createWithdrawal.php", true);
    request.send(form);
  }

}

// function CreateMerchantTransfer() {
//   var cmd = "create_transfer";//don't change
//   var amount = "0.005"; //The amount of the transfer in the currency below.
//   var merchant = ""; //The merchant ID to send the funds to, either this OR pbntag must be specified. Remember: this is a merchant ID and not a username.
//   var auto_confirm = "1";//	If set to 1, withdrawal will complete without email confirmation.
//   var currency = "LTCT"; //The cryptocurrency to withdraw. (BTC, LTC, etc.)

//   var form = new FormData();
//   form.append("cmd", cmd);
//   form.append("currency", currency);
//   form.append("amount", amount);
//   form.append("merchant", merchant);
//   form.append("auto_confirm", auto_confirm);

//   var request = new XMLHttpRequest();
//   request.onreadystatechange = function () {
//     if (request.readyState == 4 && request.status == 200) {
//       alert(request.responseText);
//       var table = document.getElementById("table");
//       var t = request.responseText;
//       alert(t);

//       table.innerHTML = t;
//     }
//   };

//   request.open("POST", "./backend/createTransfer.php", true);
//   request.send(form);
// }

// function cancelWithdrawal(){
//   var depositAddress = "cancel_withdrawal";//don't change
//   var id = ""; //The withdrawal ID to cancel. Note the withdrawal must be in the "Awaiting email confirmation" state to be able to be cancelled.

//   var form = new FormData();
//   form.append("cmd", depositAddress);
//   form.append("id", id);

//   var request = new XMLHttpRequest();
//   request.onreadystatechange = function () {
//     if (request.readyState == 4 && request.status == 200) {
//       alert(request.responseText);
//       var jsObj = JSON.parse(request.responseText);

//       //API Response
//       // no response
//     }
//   };

//   request.open("POST", "./src/coinPaymentProcess.php", true);
//   request.send(form);
// }

// function createPayment(){
//    var cmd = "create_transaction";//don't change
//    var amount = "50"; //The amount of the payment in the original currency (currency1 below). /required
//    var currency1 = "USD"; //	The original currency of the payment. /Required
//    var currency2 = "LTCT"; //The currency the buyer will be sending. For example if your products are priced in USD but you are receiving BTC, you would use currency1=USD and currency2=BTC. currency1 and currency2 can be set to the same thing if you don't need currency conversion. / Required
//    var buyer_email = "akilagimhana2005@gmail.com"; //Set the buyer's email address. This will let us send them a notice if they underpay or need a refund. We will not add them to our mailing list or spam them or anything like that. / Required
//    var address = "mies5w6k8pLioHYtEFQAyCJzYDqn6muaLM"; //	Optionally set the address to send the funds to (if not set will use the settings you have set on the 'Coins Acceptance Settings' page) Remember: this must be an address in currency2's network.
//    var buyer_name = "Akila Gimhana"; //Optionally set the buyer's name for your reference.
//    var item_name = "Laptop"; //Item name for your reference, will be on the payment information page and in the IPNs for the payment.
//    var item_number = "12312"; //	Item number for your reference, will be on the payment information page and in the IPNs for the payment.
//    var invoice = "1231asf123"; //Another field for your use, will be on the payment information page and in the IPNs for the payment.
//    var custom = ""; //	Another field for your use, will be on the payment information page and in the IPNs for the payment.
//    var ipn_url = "https://not-a-real-website.com/your_ipn_handler_script.php"; //URL for your IPN callbacks. If not set it will use the IPN URL in your Edit Settings page if you have one set.
 
//    var form = new FormData();
//    form.append("cmd", cmd);
//    form.append("currency1", currency1);
//    form.append("amount", amount);
//    form.append("currency2", currency2);
//    form.append("buyer_email", buyer_email);
//    form.append("address", address);
//    form.append("buyer_name", buyer_name);
//    form.append("item_name", item_name);
//    form.append("item_number", item_number);
//    form.append("invoice", invoice);
//    form.append("custom", custom);
//    form.append("ipn_url", ipn_url);
 
//    var request = new XMLHttpRequest();
//    request.onreadystatechange = function () {
//      if (request.readyState == 4 && request.status == 200) {
//       alert(request.responseText);
//       var table = document.getElementById("table");
//       var t = request.responseText;
//       alert(t);

//       table.innerHTML = t;
//      }
//    };
 
//    request.open("POST", "./backend/createPayment.php", true);
//    request.send(form);
// }