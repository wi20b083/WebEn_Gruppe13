const form = document.querySelector('#login');
const unameEl = document.querySelector('#uname');
const passwordEl = document.querySelector('#password');
const loginErr = document.querySelector('#loginErr');


form.addEventListener('submit', function (e) {
    e.preventDefault();
    var iv = CryptoJS.enc.Base64.parse("");
    var key = CryptoJS.SHA256(passwordEl.value.trim());
    var encryptedString = encryptData(passwordEl.value.trim(), iv, key);
    console.log(encryptedString); 

    $.ajax({
        type: "POST",
        url: "../../backend/logic/login.php",
        data: {
            uname: unameEl.value.trim(),
            password: encryptedString
        },
        async: false,
        success: function (response) {
            var json = $.parseJSON(response);

            if (json.valid) {
                window.location.href = "http://localhost/WebEnProjekt/frontend/index.php";
            } else {
                console.log("Error"); 
            }
        },
        error: function () {
            alert("Something went wrong.");
        }
    });
}); 

function encryptData(data, iv, key) {
        if (typeof data == "string") {
            data = data.slice();
            encryptedString = CryptoJS.AES.encrypt(data, key, {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            });
        }
        else {
            encryptedString = CryptoJS.AES.encrypt(JSON.stringify(data), key, {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            });
        }
        return encryptedString.toString();
    }