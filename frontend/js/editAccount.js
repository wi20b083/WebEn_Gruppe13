const id = document.querySelector("#uid");
const fnameEl = document.querySelector("#fname");
const fnameErr = document.querySelector("#fnameErr");
const lnameEl = document.querySelector("#lname");
const lnameErr = document.querySelector("#lnameErr");
const unameEl = document.querySelector("#uname");
const unameErr = document.querySelector("#unameErr");
const passwordEl = document.querySelector("#password");
const passwordErr = document.querySelector("#passwordErr");
const confpasswordEl = document.querySelector("#confpassword");
const confpasswordErr = document.querySelector("#confpasswordErr");
const emailEl = document.querySelector("#email");
const emailErr = document.querySelector("#emailErr");
const streetEl = document.querySelector("#street");
const streetErr = document.querySelector("#streetErr");
const streetnrEl = document.querySelector("#streetnr");
const streetnrErr = document.querySelector("#streetnrErr");
const cityEl = document.querySelector("#city");
const cityErr = document.querySelector("#cityErr");
const zipEl = document.querySelector("#zip");
const zipErr = document.querySelector("#zipErr");
const btnSave = document.querySelector("#btnSave");
const div = document.querySelector("#editUserForm");
const changePassword = document.querySelector("#btnChangePassword");

btnSave.setAttribute("onclick", "updateUser()");
changePassword.setAttribute("onclick", "updatePassword()");

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../../backend/logic/account.php",
    data: {},
    async: false,

    success: function (response) {
      console.log(response);

      var json = $.parseJSON(response);
      json.forEach((element) => {
        id.value = element.ID;
        unameEl.value = element.uname;
        fnameEl.value = element.fname;
        lnameEl.value = element.lname;
        emailEl.value = element.email;

        var address = element.address; // store the address
        var addressParts = address.split(" "); // split the Address by space
        var streetNumber = addressParts[addressParts.length - 1]; // get streeNumber
        var street = addressParts[0];

        streetEl.value = street;
        streetnrEl.value = streetNumber;

        cityEl.value = element.city;
        zipEl.value = element.zip;
      });
    },
    error: function (response) {
      console.log("failed");
      var x = JSON.parse(response);
      alert(x.status_code + " " + x.message);
    },
  });
});

const checkFName = () => {
  let valid = false;
  const fname = fnameEl.value.trim();
  if (!isRequired(fname)) {
    showError(fnameErr, "Firstname cannot be blank.");
  } else if (!isLetters(fname)) {
    showError(fnameErr, "Firstname must only contain letters.");
  } else {
    showSuccess(fnameErr);
    valid = true;
  }
  return valid;
};

const checkLName = () => {
  let valid = false;
  const lname = lnameEl.value.trim();
  if (!isRequired(lname)) {
    showError(lnameErr, "Lastname cannot be blank.");
  } else if (!isLetters(lname)) {
    showError(lnameErr, "Lastname must only contain letters.");
  } else {
    showSuccess(lnameErr);
    valid = true;
  }
  return valid;
};

const checkUName = () => {
  let valid = false;
  const min = 3,
    max = 25;
  const uname = unameEl.value.trim();
  if (!isRequired(uname)) {
    showError(unameErr, "Username cannot be blank.");
  } else if (!isBetween(uname.length, min, max)) {
    showError(
      unameErr,
      `Username must be between ${min} and ${max} characters.`
    );
  } else {
    showSuccess(unameErr);
    valid = true;
  }
  return valid;
};

const checkPassword = () => {
  let valid = false;
  const password = passwordEl.value.trim();
  if (!isPasswordSecure(password)) {
    showError(passwordErr, "Password does not match the criteria.");
  } else {
    showSuccess(passwordErr);
    valid = true;
  }
  return valid;
};

const checkConfPassword = () => {
  let valid = false;
  const confirmPassword = confpasswordEl.value.trim();
  const password = passwordEl.value.trim();

  if (!isRequired(confirmPassword)) {
    showError(confpasswordErr, "Please enter the password again.");
  } else if (password !== confirmPassword) {
    showError(confpasswordErr, "The password does not match.");
  } else {
    showSuccess(confpasswordErr);
    valid = true;
  }
  return valid;
};

const checkStreet = () => {
  let valid = false;
  const street = streetEl.value.trim();
  if (!isRequired(street)) {
    showError(streetErr, "Street cannot be blank.");
  } else if (!isLetters(street)) {
    showError(streetErr, "Street must only contain letters.");
  } else {
    showSuccess(streetErr);
    valid = true;
  }
  return valid;
};

const checkStreetnr = () => {
  let valid = false;
  const streetnr = streetnrEl.value.trim();
  if (!isRequired(streetnr)) {
    showError(streetnrErr, "Street number cannot be blank.");
  } else if (!isNumber(streetnr)) {
    showError(streetnrErr, "Street number must be a number.");
  } else {
    showSuccess(streetnrErr);
    valid = true;
  }
  return valid;
};

const checkCity = () => {
  let valid = false;
  const city = cityEl.value.trim();
  if (!isRequired(city)) {
    showError(cityErr, "City cannot be blank.");
  } else if (!isLetters(city)) {
    showError(cityErr, "Must only contain letters.");
  } else {
    showSuccess(cityErr);
    valid = true;
  }
  return valid;
};

const checkZip = () => {
  let valid = false;
  const zip = zipEl.value.trim();
  if (!isRequired(zip)) {
    showError(zipErr, "Zip cannot be blank.");
  } else if (!isNumber(zip)) {
    showError(zipErr, "Zip must be a number.");
  } else {
    showSuccess(zipErr);
    valid = true;
  }
  return valid;
};

const isPasswordSecure = (password) => {
  const re = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
  );
  return re.test(password);
};

const isLetters = (value) => {
  const re = new RegExp("^[a-zA-Z]{1}[a-zA-ZäöüßÄÖÜ]*$");
  return re.test(value);
};

const isNumber = (value) => {
  const re = new RegExp("^[0-9]+$");
  return re.test(value);
};

const isRequired = (value) => (value === "" ? false : true);
const isBetween = (length, min, max) =>
  length < min || length > max ? false : true;

const showError = (error, message) => {
  error.textContent = message;
};

const showSuccess = (error) => {
  error.textContent = "";
};

function updateUser() {
  console.log("random");

  let isFNameValid = checkFName(),
    isLNameValid = checkLName(),
    isUNameValid = checkUName(),
    isStreetValid = checkStreet(),
    isStreetNrValid = checkStreetnr(),
    isCityValid = checkCity(),
    isZipValid = checkZip();

  let isFormValid =
    isFNameValid &&
    isLNameValid &&
    isUNameValid &&
    isStreetValid &&
    isStreetNrValid &&
    isCityValid &&
    isZipValid;

  if (isFormValid) {
    $.ajax({
      type: "POST",
      url: "../../backend/logic/updateUser.php",
      data: {
        id: id.value.trim(),
        fname: fnameEl.value.trim(),
        lname: lnameEl.value.trim(),
        uname: unameEl.value.trim(),
        email: emailEl.value.trim(),
        street: streetEl.value.trim(),
        streetnr: streetnrEl.value.trim(),
        city: cityEl.value.trim(),
        zip: zipEl.value.trim(),
      },
      async: false,
      success: function (response) {
        window.location = "../sites/myAccount.php";
      },
      error: function (response) {
        console.log(response);
        var x = JSON.parse(response);
        alert(x.status_code + " " + x.message);
      },
    });
  }
}

function updatePassword() {
  let isPwValid = checkPassword(),
    isPwConfirmValid = checkConfPassword();

  let isFormValid = isPwValid && isPwConfirmValid;

  console.log(passwordEl.value);

  if (isFormValid) {
    var iv = CryptoJS.enc.Base64.parse("");
    var key = CryptoJS.SHA256(passwordEl.value.trim());
    var encryptedString = encryptData(passwordEl.value.trim(), iv, key);
    console.log(encryptedString);

    $.ajax({
      type: "POST",
      url: "../../backend/logic/updateUserPassword.php",
      data: {
        id: id.value.trim(),
        password: encryptedString,
      },
      async: false,
      success: function (response) {
        alert(response);
        window.location = "../sites/myAccount.php";
      },
      error: function (response) {
        console.log(response);
        var x = JSON.parse(response);
        alert(x.status_code + " " + x.message);
      },
    });
  }
}

const debounce = (fn, delay = 500) => {
  let timeoutId;
  return (...args) => {
    if (timeoutId) {
      clearTimeout(timeoutId);
    }
    timeoutId = setTimeout(() => {
      fn.apply(null, args);
    }, delay);
  };
};

div.addEventListener(
  "input",
  debounce(function (e) {
    switch (e.target.id) {
      case "fname":
        checkFName();
        break;
      case "lname":
        checkLName();
        break;
      case "uname":
        checkUName();
        break;
      case "password":
        checkPassword();
        break;
      case "confpassword":
        checkConfPassword();
        break;
      case "street":
        checkStreet();
        break;
      case "streetnr":
        checkStreetnr();
        break;
      case "city":
        checkCity();
        break;
      case "zip":
        checkZip();
        break;
    }
  })
);

div.addEventListener("reset", function () {
  showSuccess(fnameErr);
  showSuccess(lnameErr);
  showSuccess(unameErr);
  showSuccess(passwordErr);
  showSuccess(confpasswordErr);
  showSuccess(emailErr);
  showSuccess(streetErr);
  showSuccess(streetnrErr);
  showSuccess(cityErr);
  showSuccess(zipErr);
});

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
