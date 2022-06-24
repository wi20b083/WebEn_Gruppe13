$(document).ready(function () {
  $.ajax({
    url: "/WebEnProjekt/backend/logic/nav.php",
    method: "get",
    success: function (response) {
        console.log(response.length); 
      if (response.length > 2) {
        var json = $.parseJSON(response);
        for (var x in json) {
          console.log(json[x].rid);
          var rid = json[x].rid;
          if (rid === 1) {
            //admin shit
            var admin = document.createElement("li");
            admin.classList.add("nav-item");

            var adminLink = document.createElement("a");
            adminLink.classList.add("nav-link");
            adminLink.setAttribute("href", "#");
            adminLink.innerHTML =
              "<i class='fa-solid fa-pen-to-square mx-2'></i>Admin</a>";

              admin.appendChild(adminLink);

            document.getElementById("navList").appendChild(admin);
          }

          if (rid === 2) {
            var account = document.createElement("li");
            account.classList.add("nav-item");

            var accountLink = document.createElement("a");
            accountLink.classList.add("nav-link");
            accountLink.setAttribute("href", "#");
            accountLink.innerHTML =
              "<i class='fa-solid fa-user mx-2'></i>Account</a>";

            account.appendChild(accountLink);

            document.getElementById("navList").appendChild(account);

            var cart = document.createElement("li");
            cart.classList.add("nav-item");

            var cartLink = document.createElement("a");
            cartLink.classList.add("nav-link");
            cartLink.setAttribute("href", "#");
            cartLink.innerHTML =
              "<i class='fa-solid fa-shopping-cart mx-2'></i>Shopping Cart<span id='cart-item' class='badge rounded-pill bg-danger mx-2'></span></a>";

            cart.appendChild(cartLink);

            document.getElementById("navList").appendChild(cart);

            var logout = document.createElement("li");
            logout.classList.add("nav-item");

            var logoutLink = document.createElement("a");
            logoutLink.classList.add("nav-link");
            logoutLink.setAttribute(
              "href",
              "/WebEnProjekt/frontend/sites/login.php?logout=true"
            );
            logoutLink.innerHTML =
              "<i class='fa-solid fa-arrow-right-from-bracket mx-2'></i>Logout";

            logout.appendChild(logoutLink);

            document.getElementById("navList").appendChild(logout);
          }
        }
      } else {
        var login = document.createElement("li");
        login.classList.add("nav-item");

        var loginLink = document.createElement("a");
        loginLink.classList.add("nav-link");
        loginLink.setAttribute(
          "href",
          "/WebEnProjekt/frontend/sites/login.php"
        );
        loginLink.innerHTML = "<i class='fa-solid fa-arrow-right-to-bracket mx-2'></i>Login";

        login.appendChild(loginLink);

        document.getElementById("navList").appendChild(login);

        var signup = document.createElement("li");
        signup.classList.add("nav-item");

        var signupLink = document.createElement("a");
        signupLink.classList.add("nav-link");
        signupLink.setAttribute(
          "href",
          "/WebEnProjekt/frontend/sites/signup.php"
        );
        signupLink.innerHTML = "<i class='fa-solid fa-user-plus mx-2'></i>Sign Up";

        signup.appendChild(signupLink);

        document.getElementById("navList").appendChild(signup);
      }
    },
  });
});
