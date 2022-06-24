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

            //admin list item
            var admin = document.createElement("li");
            admin.classList.add("nav-item");
            admin.classList.add("dropdown");

            //admin link
            var adminLink = document.createElement("a");
            adminLink.classList.add("nav-link");
            adminLink.classList.add("dropdown-toggle");
            adminLink.setAttribute("id", "navBarDropdownMenuLink");
            adminLink.setAttribute("role", "button");
            adminLink.setAttribute("data-bs-toggle", "dropdown");
            adminLink.setAttribute("aria-expanded", "false");
            adminLink.setAttribute("href", "#");
            adminLink.innerHTML =
              "<i class='fa-solid fa-pen-to-square mx-2'></i>Admin</a>";
            admin.appendChild(adminLink);

            //dropdown menu
            var dropdownMenu = document.createElement("ul");
            dropdownMenu.classList.add("dropdown-menu");

            //dropdown menu list item edit
            var dItem1 = document.createElement("li");

            var dItem1Link = document.createElement("a");
            dItem1Link.classList.add("dropdown-item");
            dItem1Link.setAttribute("href", "/WebEnProjekt/frontend/sites/editProducts.php");
            dItem1Link.innerHTML =
              "<i class='fa-solid fa-file-pen mx-2'></i>Edit Product</a>";
            dItem1.appendChild(dItem1Link);
            dropdownMenu.appendChild(dItem1); 

            //dropdown menu list item add
            var dItem2 = document.createElement("li");

            var dItem2Link = document.createElement("a");
            dItem2Link.classList.add("dropdown-item");
            dItem2Link.setAttribute("href", "/WebEnProjekt/frontend/sites/newProduct.php");
            dItem2Link.innerHTML =
              "<i class='fa-solid fa-plus mx-2'></i>Add Product</a>";
              dItem2.appendChild(dItem2Link);
            dropdownMenu.appendChild(dItem2);


            admin.appendChild(dropdownMenu); 
            document.getElementById("navList").appendChild(admin);
          }

          if (rid === 2) {
            var account = document.createElement("li");
            account.classList.add("nav-item");

            var accountLink = document.createElement("a");
            accountLink.classList.add("nav-link");
            accountLink.setAttribute(
              "href",
              "/WebEnProjekt/frontend/sites/myAccount.php"
            );
            accountLink.innerHTML =
              "<i class='fa-solid fa-user mx-2'></i>Account</a>";

            account.appendChild(accountLink);

            document.getElementById("navList").appendChild(account);

            var cart = document.createElement("li");
            cart.classList.add("nav-item");

            var cartLink = document.createElement("a");
            cartLink.classList.add("nav-link");
            cartLink.setAttribute("href", "/WebEnProjekt/frontend/sites/cart.php");
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
        loginLink.innerHTML =
          "<i class='fa-solid fa-arrow-right-to-bracket mx-2'></i>Login";

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
        signupLink.innerHTML =
          "<i class='fa-solid fa-user-plus mx-2'></i>Sign Up";

        signup.appendChild(signupLink);

        document.getElementById("navList").appendChild(signup);
      }
    },
  });
});
