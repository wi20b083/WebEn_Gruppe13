
//main element where the List will be created 
var main = document.getElementById("main");


//document ready function which trigger when the document ist finished loading 
$(document).ready(function () {
  
//gets all users and creates the elements of the tableview where the users are displayed 
  $.ajax({
    type: "GET",
    url: "../../backend/logic/listUsers.php",
    data: {},
    async: false,

    success: function (response) {
      var table = document.createElement("table");
      table.setAttribute("class", "table");
      main.appendChild(table);

      var tableHead = document.createElement("thead");
      table.appendChild(tableHead);

      var headTr = document.createElement("tr");
      tableHead.appendChild(headTr);

      var colId = document.createElement("th");
      colId.setAttribute("scope", "col");
      colId.innerHTML = "#";
      headTr.appendChild(colId);

      var colUname = document.createElement("th");
      colUname.setAttribute("scope", "col");
      colUname.innerHTML = "Username";
      headTr.appendChild(colUname);

      var colFname = document.createElement("th");
      colFname.setAttribute("scope", "col");
      colFname.innerHTML = "First Name";
      headTr.appendChild(colFname);

      var colLname = document.createElement("th");
      colLname.setAttribute("scope", "col");
      colLname.innerHTML = "Last Name";
      headTr.appendChild(colLname);

      var colEmail = document.createElement("th");
      colEmail.setAttribute("scope", "col");
      colEmail.innerHTML = "E-Mail";
      headTr.appendChild(colEmail);

      var colAddress = document.createElement("th");
      colAddress.setAttribute("scope", "col");
      colAddress.innerHTML = "Address";
      headTr.appendChild(colAddress);

      var colCity = document.createElement("th");
      colCity.setAttribute("scope", "col");
      colCity.innerHTML = "City";
      headTr.appendChild(colCity);

      var colZip = document.createElement("th");
      colZip.setAttribute("scope", "col");
      colZip.innerHTML = "ZIP";
      headTr.appendChild(colZip);

      var colOrders = document.createElement("th");
      colOrders.setAttribute("scope", "col");
      colOrders.innerHTML = "Orders";
      headTr.appendChild(colOrders);

      var colActivate = document.createElement("th");
      colActivate.setAttribute("scope", "col");
      colActivate.innerHTML = "Status";
      headTr.appendChild(colActivate);

      var tableBody = document.createElement("tbody");
      table.appendChild(tableBody);

      var json = $.parseJSON(response);
      json.forEach((element) => {
        var bodyTr = document.createElement("tr");
        tableBody.appendChild(bodyTr);

        var thId = document.createElement("th");
        thId.setAttribute("scope", "row");
        thId.innerHTML = element.ID;
        bodyTr.appendChild(thId);

        var trUname = document.createElement("td");
        trUname.innerHTML = element.uname;
        bodyTr.appendChild(trUname);

        var trFname = document.createElement("td");
        trFname.innerHTML = element.fname;
        bodyTr.appendChild(trFname);

        var trLname = document.createElement("td");
        trLname.innerHTML = element.lname;
        bodyTr.appendChild(trLname);

        var trEmail = document.createElement("td");
        trEmail.innerHTML = element.email;
        bodyTr.appendChild(trEmail);

        var trAddress = document.createElement("td");
        trAddress.innerHTML = element.address;
        bodyTr.appendChild(trAddress);

        var trCity = document.createElement("td");
        trCity.innerHTML = element.city;
        bodyTr.appendChild(trCity);

        var trZip = document.createElement("td");
        trZip.innerHTML = element.zip;
        bodyTr.appendChild(trZip);

        var tdViewOrders = document.createElement("td");
        bodyTr.appendChild(tdViewOrders);

        var buttonOrders = document.createElement("button");
        buttonOrders.innerHTML = "View Orders";
        //button which triggers the modal to see the orders 
        tdViewOrders.innerHTML =
          '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="' +
          element.ID +
          '">View Orders</button>';
        

        var tdChangeStatus = document.createElement("td");
        bodyTr.appendChild(tdChangeStatus);

        var buttonActivate = document.createElement("button");
        buttonActivate.classList.add("btn"); 

         
        //getting status of user --> activated, deactivated
        var status = getStatus(element.ID);
        
        console.log(status)
        //sets button innner html and color where User can be set on activ oder deactivated 
        if(status) {
          console.log("activated")
          buttonActivate.classList.add("btn-danger")
          buttonActivate.innerHTML = "Deactivate User";
        } else {
          console.log("deactivated")
          buttonActivate.classList.add("btn-success")
          buttonActivate.innerHTML = "Activate User";
        }
        
        //onclick function for change status 
        tdChangeStatus.appendChild(buttonActivate).onclick = function (e) {
          changeStatus(element.ID, status); 
        };
      });
    },
    error: function (response) {
      console.log("failed");
      var x = JSON.parse(response);
      alert(x.status_code + " " + x.message);
    },
  });
//getting modal 
  var exampleModal = document.getElementById("exampleModal");
  exampleModal.addEventListener("show.bs.modal", function (event) {

    //function which is triggerd when the admin click on the order list of the user 
    var button = event.relatedTarget;
    var id = button.getAttribute("data-bs-whatever");
    $.ajax({
      type: "GET",
      url: "../../backend/logic/getUserOrders.php",
      data: {
        id: id,
      },
      async: false,

      success: function (response) {
        //creating list of orders from a specific user

        if (response.length > 2) {
          var json = $.parseJSON(response);
          if (json.length != 2) {
            for (var key in json) {
              if (key == "data") {
                var data = json[key];
                for (var x in data) {
                  var element = data[x];

                  var total = 0;

                  console.log(element.oid);
                  var timestamp = element.time;

                  var a = document.createElement("a");
                  a.setAttribute(
                    "class",
                    "list-group-item list-group-item-action"
                  );

                  var div = document.createElement("div");
                  div.setAttribute(
                    "class",
                    "d-flex w-100 justify-content-between"
                  );

                  a.appendChild(div);

                  var orderHead = document.createElement("h5");
                  orderHead.classList.add("mb-1");
                  orderHead.innerText = "Order number " + element.oid;
                  div.appendChild(orderHead);
                  div.appendChild(document.createElement("hr"));

                  var time = document.createElement("small");
                  time.classList.add("text-muted");
                  time.innerText = timestamp;

                  div.appendChild(time);

                  var p = document.createElement("p");
                  p.classList.add("mb-1");
                  a.appendChild(p);

                  var sm = document.createElement("small");
                  sm.classList.add("text-muted");
                  a.appendChild(sm);
                    //getting order inforamtion 
                  $.ajax({
                    type: "GET",
                    url: "../../backend/logic/getOrderInformation.php",
                    data: {
                      oid: element.oid,
                      uid: element.uid,
                    },
                    async: false,

                    success: function (response) {
                      console.log(response);
                      //parsing and adding the order information to the elements
                      var json = $.parseJSON(response);
                      for (var key in json) {
                        switch (key) {
                          case "user": {

                            //user information 
                            var user = json[key][0];
                            var header = document.getElementById("modalHeader");
                            header.innerText =
                              "Viewing all orders by: " +
                              user.fname +
                              " " +
                              user.lname;

                            sm.innerHTML =
                              "Sent to " +
                              user.adress +
                              ", " +
                              user.zip +
                              " " +
                              user.city;
                            break;
                          }
                          case "po": {
                            //po = productorders --> gets the qty of the  products 
                            var po = json[key];

                            for (var x in po) {
                              var item = po[x];
                              console.log(item); // still to add

                              var row = document.createElement("div");
                              row.classList.add("row");
                              row.setAttribute("id", "row" + item.pid);

                              var col1 = document.createElement("div");
                              col1.classList.add("col");
                              col1.classList.add("colName");
                              col1.setAttribute("id", "colName" + item.pid);

                              var col2 = document.createElement("div");
                              col2.classList.add("col");
                              col2.classList.add("colPrice");
                              col2.setAttribute("id", "colPrice" + item.pid);

                              var col3 = document.createElement("div");
                              col3.classList.add("col");
                              col3.classList.add("colQty");
                              col3.setAttribute("id", "colQty" + item.pid);
                              col3.innerText = item.qty;

                              row.appendChild(col1);
                              row.appendChild(col3);
                              row.appendChild(col2);

                              p.appendChild(row);
                            }

                            break;
                          }
                          case "product": {
                            //gets the price and the product name
                            var products = json[key];

                            for (var y in products) {
                              var product = products[y];

                              total +=
                                Number(product.pprice) *
                                Number(
                                  a.querySelector(
                                    "div#colQty" + product.pid + ".col.colQty"
                                  ).innerText
                                );

                              console.log(product); // still to add

                              var nameCol = a.querySelector(
                                "div#colName" + product.pid + ".col.colName"
                              );
                              nameCol.innerText = product.pname;

                              var priceCol = a.querySelector(
                                "div#colPrice" + product.pid + ".col.colPrice"
                              );
                              priceCol.innerText =
                                new Intl.NumberFormat("de-DE", {
                                  minimumFractionDigits: 2,
                                  maximumFractionDigits: 2,
                                }).format(product.pprice) + "€";
                            }
                            break;
                          }
                        }
                      }
                    },
                    error: function (response) {
                      console.log("failed");
                      var x = JSON.parse(response);
                      alert(x.status_code + " " + x.message);
                    },
                  });

                  var endPriceRow = document.createElement("div");
                  endPriceRow.classList.add("row");

                  var endPriceCol = document.createElement("div");
                  endPriceCol.classList.add("col");
                  endPriceCol.innerText =
                    "Total: " +
                    new Intl.NumberFormat("de-DE", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    }).format(total) +
                    "€";

                  endPriceRow.appendChild(endPriceCol);
                  p.appendChild(document.createElement("hr"));
                  p.appendChild(endPriceRow);

                  document.getElementById("orderList").appendChild(a);
                }
              }
            }
          }
        }
      },
      error: function (response) {
        console.log("failed");
        var x = JSON.parse(response);
        alert(x.status_code + " " + x.message);
      },
    });
  });

  $("#modalClose").click(function (e) {
    location.reload();
  });
});


//function which is triggerd to change the status of a user 
function changeStatus(id, status) {

  console.log(id, status)
  $.ajax({
    url: "../../backend/logic/changeStatus.php", 
    method: "get", 
    data: {id: id, status: status},
    async: false,
    success: function(response) {
      console.log(response)
       
    }
  }); 
  location.reload();
}

//function which gets the status of the user 
function getStatus(id) {
  var status; 
  $.ajax({
    url: "../../backend/logic/status.php",
    method: "get", 
    data: {id: id},
    async: false,
    success: function(response) {
      var json = $.parseJSON(response);
      
      status = Boolean(json); 
    }
  });
  return status
}
