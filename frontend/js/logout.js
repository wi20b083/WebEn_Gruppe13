window.addEventListener("beforeunload", function () {
    $.ajax({ 
        type: "GET", 
        url: "../../backend/logic/login.php?logout=true",
    }); 
  }); 