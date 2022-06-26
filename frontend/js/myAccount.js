//document ready function to get the Account data - with the help of the php $_SESSION var  
$(document).ready(function () {

  //getting the elements of the html 
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
      //setting the value of the elements
      var json = $.parseJSON(response);
      json.forEach((element) => {
        uname.value = element.uname;
        fname.value = element.fname;
        lname.value = element.lname;
        email.value = element.email;
        address.value = element.address;
        city.value = element.city;
        zip.value = element.zip;
        //greeting 
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
