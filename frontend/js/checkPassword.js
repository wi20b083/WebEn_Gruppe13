var passwordEl = document.getElementById("password");
var passwordErr = document.getElementById("checkPasswordError");
var buttonConfirm = document.getElementById("confirmPassword");
buttonConfirm.setAttribute("onclick", "checkPassword()");

function checkPassword() {
  var iv = CryptoJS.enc.Base64.parse("");
  var key = CryptoJS.SHA256(passwordEl.value.trim());
  var encryptedString = encryptData(passwordEl.value.trim(), iv, key);
  console.log(encryptedString);

  $.ajax({
    type: "POST",
    url: "../../backend/logic/checkPassword.php",
    data: {
      password: encryptedString,
    },
    async: false,

    success: function (response) {
      var json = $.parseJSON(response);

      if (json.valid) {
        window.location.href =
          "http://localhost/WebEnProjekt/frontend/sites/editMyAccount.php";
      } else {
        passwordErr.innerHTML = "Password wrong!";
      }
    },
    error: function (response) {
      console.log("failed");
      var x = JSON.parse(response);
      alert(x.status_code + " " + x.message);
    },
  });
}

function encryptData(data, iv, key) {
  if (typeof data == "string") {
    data = data.slice();
    encryptedString = CryptoJS.AES.encrypt(data, key, {
      iv: iv,
      mode: CryptoJS.mode.CBC,
      padding: CryptoJS.pad.Pkcs7,
    });
  } else {
    encryptedString = CryptoJS.AES.encrypt(JSON.stringify(data), key, {
      iv: iv,
      mode: CryptoJS.mode.CBC,
      padding: CryptoJS.pad.Pkcs7,
    });
  }
  return encryptedString.toString();
}
