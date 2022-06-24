$(document).ready(function () {
  $.ajax({
    url: "../../backend/logic/action.php",
    method: "get",
    success: function (response) {
      var totalCost = 0;
      if (response != "") {
        var json = $.parseJSON(response);
        console.log(json);
        for (var key in json) {
          console.log(key);
          if (key == "data") {
            var data = json[key];

            for (var x in data) {
              var element = data[x];
              var tr = document.createElement("tr");

              var id_td = document.createElement("td");
              id_td.innerText = element.id;
              tr.appendChild(id_td);

              var id = document.createElement("input");
              id.setAttribute("type", "hidden");
              id.classList.add("pid");
              id.setAttribute("value", element.id);
              tr.appendChild(id);

              var img_td = document.createElement("td");

              var img = document.createElement("img");
              img.setAttribute("src", "../../backend/" + element.product_image);
              img.setAttribute("width", 50);
              img_td.appendChild(img);

              tr.appendChild(img_td);

              var name = document.createElement("td");
              name.innerText = element.product_name;
              tr.appendChild(name);

              var price_td = document.createElement("td");
              price_td.innerText =
                new Intl.NumberFormat("de-DE", {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2,
                }).format(element.product_price) + "€";
              tr.appendChild(price_td);
              tr.appendChild(price_td);

              var price = document.createElement("input");
              price.setAttribute("type", "hidden");
              price.classList.add("pprice");
              price.setAttribute("value", element.product_price);
              tr.appendChild(price);

              var qty_td = document.createElement("td");

              var qty = document.createElement("input");
              qty.classList.add("form-control");
              qty.classList.add("itemQty");
              qty.setAttribute("type", "number");
              qty.setAttribute("value", element.qty);
              qty_td.appendChild(qty).onchange = function (e) {
                e.preventDefault();
                onChange($(this));
              };

              tr.appendChild(qty_td);

              var total = document.createElement("td");
              total.innerText =
                new Intl.NumberFormat("de-DE", {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2,
                }).format(element.total_price) + "€";
              tr.appendChild(total);

              var remove_td = document.createElement("td");

              var remove = document.createElement("a");
              remove.classList.add("btn");
              remove.classList.add("btnRemove");
              remove.classList.add("btn-danger");
              remove.classList.add("btn-sm");
              remove.classList.add("text-nowrap");
              remove.classList.add("w-100");
              remove.setAttribute("role", "button");
              remove.setAttribute(
                "href",
                "../../backend/logic/action.php?remove=" + element.id
              );

              remove.innerHTML =
                "<i class='fa-solid fa-trash me-2'></i>Remove item";

              remove_td.appendChild(remove).onclick = function (e) {
                e.preventDefault();
                onClick(element.id);
              };

              tr.appendChild(remove_td);

              var body = document.getElementById("tbody");
              body.appendChild(tr);

              console.log(totalCost);
              totalCost += Number(element.total_price);
              console.log(totalCost);
            }
          }
        }
      }
      var tr1 = document.createElement("tr");

      var td1 = document.createElement("td");
      td1.setAttribute("colspan", 3);
      tr1.appendChild(td1);

      var a1 = document.createElement("a");
      a1.classList.add("btn");
      a1.classList.add("btn-success");
      a1.classList.add("text-nowrap");
      a1.classList.add("w-100");
      a1.setAttribute("href", "../index.php");

      a1.innerHTML =
        "<i class='fa-solid fa-shopping-cart me-2'></i>Continue Shopping";

      td1.appendChild(a1);

      tr1.appendChild(td1);

      var td2 = document.createElement("td");
      td2.setAttribute("colspan", 2);

      var b1 = document.createElement("b");
      b1.innerText = "Grand Total";

      td2.appendChild(b1);

      tr1.appendChild(td2);

      var td3 = document.createElement("td");

      var b2 = document.createElement("b");
      b2.innerText =
        new Intl.NumberFormat("de-DE", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        }).format(totalCost) + "€";

      td3.appendChild(b2);

      tr1.appendChild(td3);

      var td4 = document.createElement("td");

      var a2 = document.createElement("a");
      a2.classList.add("btn");
      a2.classList.add("btn-info");
      a2.classList.add("text-nowrap");
      a2.classList.add("w-100");
      if (totalCost > 1) {
        a2.setAttribute("disabled", "");
      }
      a1.setAttribute("href", "../index.php");

      a2.innerHTML = "<i class='fa-solid fa-credit-card me-2'></i>Checkout";

      td4.appendChild(a2).onclick = function (e) {
        e.preventDefault;
        $.ajax({
          url: "../../backend/logic/order.php",
          method: "get",
          success: function (response) {
            console.log(response); 
            $("#order").html(response);
          },
        });
      };

      tr1.appendChild(td4);

      var body = document.getElementById("tbody");
      body.appendChild(tr1);
    },
  });

  load_cart_item_number();

  $("#btnRemoveAll").click(function (e) {
    e.preventDefault();
    if (confirm("Are you sure want to clear your cart?")) {
      $.ajax({
        url: "../../backend/logic/action.php?remove=all",
        method: "get",
        data: {
          remove: "all",
        },
        success: function () {
          location.reload();
        },
      });
    }
  });
});

function load_cart_item_number() {
  $.ajax({
    url: "../../backend/logic/action.php",
    method: "get",
    success: function (response) {
      if (response != "") {
        var json = $.parseJSON(response);
        console.log(json);
        $("#cart-item").html(json.count);
      } else {
        $("#cart-item").html(0);
      }
    },
  });
}

function onClick(id) {
  if (confirm("Are you sure want to remove this item?")) {
    $.ajax({
      url: "../../backend/logic/action.php",
      method: "get",
      data: {
        remove: id,
      },
      success: function () {
        location.reload();
      },
    });
  }
}

function onChange(btn) {
  var $el = btn.closest("tr");

  var pid = $el.find(".pid").val();
  var pprice = $el.find(".pprice").val();
  var qty = $el.find(".itemQty").val();
  $.ajax({
    url: "../../backend/logic/action.php",
    method: "post",
    cache: false,
    async: false,
    data: {
      method: "update",
      qty: qty,
      pid: pid,
      pprice: pprice,
    },
    success: function () {
      location.reload();
    },
  });
}
