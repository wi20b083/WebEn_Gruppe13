$(document).ready(function () {
  var uname = document.getElementById("uname");
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var address = document.getElementById("address");
  var city = document.getElementById("city");
  var zip = document.getElementById("zip");

  var buttonSave = document.getElementById("btnedit");

  var greeting = document.getElementById("gretting");

  var linkedit = document.getElementById("linkedit");

  $.ajax({
    type: "GET",
    url: "../../backend/logic/account.php",
    data: {},
    async: false,

    success: function (response) {
      console.log(response);

      var json = $.parseJSON(response);
      json.forEach((element) => {
        uname.value = element.uname;
        fname.value = element.fname;
        lname.value = element.lname;
        email.value = element.email;
        address.value = element.address;
        city.value = element.city;
        zip.value = element.zip;
        greeting.innerHTML = "Hello " + element.fname + "!";
      });
    },
    error: function (response) {
      console.log("failed");
      var x = JSON.parse(response);
      alert(x.status_code + " " + x.message);
    },
  });
});
