$(document).ready(function () {

  //loads all products
  load_from_db("all");

  //for adding items to the shopping cart
  $(".addItemBtn").click(function (e) {
    e.preventDefault();
    var $form = $(this).closest(".form-submit");
    var pid = $form.find(".id").val();
    var pname = $form.find(".name").val();
    var pprice = $form.find(".price").val();
    var pimage = $form.find(".img").val();
    var pcode = $form.find(".code").val();
    var pqty = $form.find(".quantity").val();

    //sending item data
    $.ajax({
      url: '../backend/logic/action.php',
      method: 'post',
      data: {
        method: "add",
        pid: pid,
        pname: pname,
        pprice: pprice,
        pqty: pqty,
        pimage: pimage,
        pcode: pcode
      },

      //displaying a message
      success: function (response) {
        var json = $.parseJSON(response); 
        var alert = document.createElement("div"); 
        alert.classList.add("alert"); 
        if(json.message === "Item has been added to your cart.") {
          alert.classList.add("alert-success");
        } else {
          alert.classList.add("alert-danger");
        }
        alert.classList.add("alert-dismissible");
        alert.classList.add("m-2");

        var btn = document.createElement("button"); 
        btn.classList.add("btn-close");
        btn.setAttribute("type", "button");
        btn.setAttribute("data-bs-dismiss", "alert");  
        alert.appendChild(btn); 

        var strong = document.createElement("strong");
        strong.innerText = json.message; 
        alert.appendChild(strong); 

        $("#message").html(alert);
        load_cart_item_number();
      }
    });
  });

  //display number of items in the navbar
  load_cart_item_number();

  //filtering items
  $("#btnAll").click(function (e) {
    $("#row0").empty(); 
    load_from_db("all");
  });

  $("#btnShirt").click(function (e) {
    $("#row0").empty();
    load_from_db("shirt");
  });

  $("#btnSweater").click(function (e) {
    $("#row0").empty();
    load_from_db("sweater");
  });

  $("#btnPants").click(function (e) {
    $("#row0").empty();
    load_from_db("pants");
  });

  $("#btnSearch").click(function (e) {
    var searchterm = $("#txtSearch").val(); 
    $("#row0").empty();
    load_from_db(searchterm); 
  }); 

});

//loading number of items in cart
function load_cart_item_number() {
  $.ajax({
    url: '../backend/logic/action.php',
    method: 'get',
    success: function (response) {
      var json = $.parseJSON(response);
      console.log(json); 
      $("#cart-item").html(json.count);
    }
  });
}


function load_from_db(method) {

  //load products from database
  $.ajax({
    url: "../backend/logic/index.php",
    method: "get",
    data: {
      method: method
    },
    async: false,
    success: function (response) {
      var json = $.parseJSON(response);
      json.forEach(element => {

        //for search autocomplete
        if(method == "all") {
        var datalist = document.getElementById("datalistOptions");
        var option = document.createElement("option");
        option.setAttribute("value", element.product_name);
        datalist.appendChild(option);
        }

        //creating card view

        //col
        var col = document.createElement("div");
        col.classList.add("col-auto");
        col.classList.add("my-2");
        col.setAttribute("id", "col" + element.id);
        col.style.height = "600px";
        document.getElementById("row0").appendChild(col);

        //card deck
        var deck = document.createElement("div");
        deck.classList.add("card-deck");
        deck.classList.add("h-100");
        deck.classList.add("w-100");
        col.appendChild(deck);

        //card
        var card = document.createElement("div");
        card.setAttribute("id", "card" + element.id);
        card.classList.add("card");
        card.classList.add("h-100");
        card.classList.add("w-100");
        card.classList.add("border-secondary");
        card.style.padding = "5px";
        deck.appendChild(card);

        //img
        var img = document.createElement("img");
        img.classList.add("card-img-top");
        img.setAttribute("id", "img" + element.id);
        img.setAttribute("src", "../backend/" + element.product_image);
        img.style.height = "40%";
        img.style.objectFit = "contain";
        card.appendChild(img);

        //card body
        var body = document.createElement("div");
        body.classList.add("card-body");
        body.setAttribute("id", "card_body" + element.id);
        card.appendChild(body);

        //name
        var name = document.createElement("h4");
        name.classList.add("card-title");
        name.classList.add("text-center");
        name.classList.add("text-info");
        name.innerText = element.product_name;
        body.appendChild(name);

        //price
        var price = document.createElement("h5");
        price.classList.add("card-title");
        price.classList.add("text-center");
        price.classList.add("text-danger");
        price.innerText = new Intl.NumberFormat('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(element.product_price) + "€";
        body.appendChild(price);

        //card footer
        var footer = document.createElement("div");
        footer.classList.add("card-footer");
        footer.setAttribute("id", "card_footer" + element.id);
        card.appendChild(footer);

        //form
        var form = document.createElement("form");
        form.classList.add("form-submit");
        form.setAttribute("id", "form" + element.id);
        footer.appendChild(form);

        //row
        var form_row = document.createElement("div");
        form_row.classList.add("row");
        form_row.classList.add("align-items-center");
        form_row.classList.add("m-2");
        form_row.setAttribute("id", "form_row" + element.id);
        form.appendChild(form_row);

        //col
        var form_col_a = document.createElement("div");
        form_col_a.classList.add("col");
        form_col_a.classList.add("m-2");
        form_col_a.setAttribute("id", "form_col_a_" + element.id);
        form_row.appendChild(form_col_a);

        //bold
        var bold = document.createElement("b");
        bold.innerText = "Quantity: ";
        form_col_a.appendChild(bold);

        //col
        var form_col_b = document.createElement("div");
        form_col_b.classList.add("col");
        form_col_b.classList.add("m-2");
        form_col_b.setAttribute("id", "form_col_b_" + element.id);
        form_row.appendChild(form_col_b);

        //input
        var qty = document.createElement("input");
        qty.classList.add("form-control");
        qty.classList.add("quantity");
        qty.classList.add("align-middle");
        qty.setAttribute("type", "number");
        qty.setAttribute("min", 1);
        qty.setAttribute("step", 1);
        qty.setAttribute("value", 1);
        form_col_b.appendChild(qty);

        //input
        var form_id = document.createElement("input");
        form_id.classList.add("id");
        form_id.setAttribute("id", "card" + element.id + "_id");
        form_id.setAttribute("type", "hidden");
        form_id.setAttribute("value", element.id);
        form.appendChild(form_id);

        //input
        var form_name = document.createElement("input");
        form_name.classList.add("name");
        form_name.setAttribute("id", "card" + element.id + "_name");
        form_name.setAttribute("type", "hidden");
        form_name.setAttribute("value", element.product_name);
        form.appendChild(form_name);

        //input
        var form_price = document.createElement("input");
        form_price.classList.add("price");
        form_price.setAttribute("id", "card" + element.id + "_price");
        form_price.setAttribute("type", "hidden");
        form_price.setAttribute("value", element.product_price);
        form.appendChild(form_price);

        //input
        var form_image = document.createElement("input");
        form_image.classList.add("img");
        form_image.setAttribute("id", "card" + element.id + "_image");
        form_image.setAttribute("type", "hidden");
        form_image.setAttribute("value", element.product_image);
        form.appendChild(form_image);

        //input
        var form_code = document.createElement("input");
        form_code.classList.add("code");
        form_code.setAttribute("id", "card" + element.id + "_code");
        form_code.setAttribute("type", "hidden");
        form_code.setAttribute("value", element.product_code);
        form.appendChild(form_code);

        //input
        var form_category = document.createElement("input");
        form_category.classList.add("category");
        form_category.setAttribute("id", "card" + element.id + "_category");
        form_category.setAttribute("type", "hidden");
        form_category.setAttribute("value", element.product_category);
        form.appendChild(form_category);

        //button
        var form_button = document.createElement("button");
        form_button.classList.add("btn");
        form_button.classList.add("btn-info");
        form_button.classList.add("w-100");
        form_button.classList.add("addItemBtn");
        form_button.setAttribute("id", "card" + element.id + "_button")

        //i
        var i = document.createElement("i");
        i.classList.add("fas");
        i.classList.add("fa-cart");
        form_button.appendChild(i);

        form_button.innerText = "Add to cart"
        form.appendChild(form_button);
      });
    }
  });
}