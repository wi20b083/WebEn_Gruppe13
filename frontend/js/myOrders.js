var divAllOrders = document.getElementById("myOrders");
var id = null;

$(document).ready(function () {
  var props = "";
  $.ajax({
    type: "GET",
    url: "../../backend/logic/account.php",
    data: {},
    async: false,

    success: function (response) {
      var json = $.parseJSON(response);
      json.forEach((element) => {
        id = element.ID;
      });

      $.ajax({
        type: "GET",
        url: "../../backend/logic/getUserOrders.php",
        data: {
          id: id,
        },
        async: false,

        success: function (response) {
          if (response.length > 2) {
            var json = $.parseJSON(response);
            if (json.length != 2) {
              for (var key in json) {
                if (key == "data") {
                  var data = json[key];
                  for (var x in data) {
                    var element = data[x];

                    var total = 0;

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
                    orderHead.innerText = "Order #" + element.oid;
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

                    var pdfCol = document.createElement("div");
                    pdfCol.classList.add("col-3");

                    var btnPdf = document.createElement("button");
                    btnPdf.setAttribute("class", "btn btn-primary");
                    btnPdf.setAttribute("oid", element.oid);
                    btnPdf.innerText = "Show PDF";

                    $.ajax({
                      type: "GET",
                      url: "../../backend/logic/getOrderInformation.php",
                      data: {
                        oid: element.oid,
                        uid: element.uid,
                      },
                      async: false,

                      success: function (response) {
                        var json = $.parseJSON(response);

                        for (var key in json) {
                          switch (key) {
                            case "user": {
                              var user = json[key][0];
                              /* var header =
                                document.getElementById("modalHeader");
                              header.innerText =
                                "Viewing all orders by: " +
                                user.fname +
                                " " +
                                user.lname; */

                              sm.innerHTML =
                                user.fname +
                                " " +
                                user.lname +
                                " | " +
                                user.email +
                                " | " +
                                user.adress +
                                ", " +
                                user.zip +
                                ", " +
                                user.city;

                              break;
                            }
                            case "po": {
                              var po = json[key];

                              for (var x in po) {
                                var item = po[x];

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
                              n = true;
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

                    pdfCol.appendChild(btnPdf).onclick = function (e) {
                      var btn = e.target;
                      var oid = $(btn)
                        .closest(".list-group-item")
                        .children("div")
                        .children("h5")
                        .text()
                        .replace(/^\D+/g, "");
                      var invoiceDate = $(btn)
                        .closest(".list-group-item")
                        .children("div")
                        .children("small")
                        .text();
                      var userDetails = $(btn)
                        .closest(".list-group-item")
                        .children("small")
                        .text()
                        .split(" | ");
                      var userName = userDetails[0];
                      var userEmail = userDetails[1];
                      var userAddress = userDetails[2];

                      var p = Array.from(
                        $(btn)
                          .closest(".list-group-item")
                          .children("p")
                          .children("div.row")
                          .children(".col"),
                        ({ textContent }) => textContent.trim()
                      )
                        .filter(Boolean)
                        .join(";");

                      prod = Array();
                      res = p.split(";");
                      var i = Number(0);
                      var j = Number(1);
                      var tot = Number(0);
                      var arr = [null];
                      for (x in res) { 
                        arr.push(res[x]);

                        if (i == 2) {
                          arr[0] = String(j);
                          j += Number(1);
                          arr[4] = parseFloat(arr[2]) * parseFloat(arr[3].replace("€", ""));
                          tot += arr[4];
                          arr[4] = new Intl.NumberFormat("de-DE", {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2,
                          }).format(arr[4]) + "€";
                          prod.push(arr);
                          arr = [null];
                          i = Number(-1);
                        }
                        i++;
                      }

                      console.log(prod);

                      tot =
                        new Intl.NumberFormat("de-DE", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        }).format(tot);

                      props = {
                        outputType: jsPDFInvoiceTemplate.OutputType.Save,
                        returnJsPDFDocObject: true,
                        fileName: "Order #" + oid,
                        orientationLandscape: false,
                        compress: true,
                        logo: {
                          src: "../../backend/image/logo-clothing-gs.png",
                          type: "PNG", //optional, when src= data:uri (nodejs case)
                          width: 53.33, //aspect ratio = width/height
                          height: 26.66,
                          margin: {
                            top: 0, //negative or positive num, from the current position
                            left: 0, //negative or positive num, from the current position
                          },
                        },
                        business: {
                          name: "Clothing-Gs GmbH",
                          address: "Hochstädterplatz 6, 1200 Wien, Österreich",
                          phone: "+43 676 123123123",
                          email: "clothing-gs@webshop.com",
                          email_1: "info@clothing-gs.at",
                        },
                        contact: {
                          label: "Invoice issued for:",
                          name: userName,
                          address: userAddress,
                          email: userEmail,
                        },
                        invoice: {
                          label: "Invoice #: ",
                          num: oid,
                          invGenDate: "Invoice issued on: " + invoiceDate,
                          headerBorder: false,
                          tableBodyBorder: false,
                          header: [
                            {
                              title: "#",
                              style: {
                                width: 10,
                              },
                            },
                            {
                              title: "Title",
                              style: {
                                width: 30,
                              },
                            },
                            { title: "Quantity" },
                            { title: "Price" },
                            { title: "Total" },
                          ],
                          table: prod,
                          additionalRows: [
                            {
                              col1: "Total:",
                              col2: tot,
                              col3: "€",
                              style: {
                                fontSize: 14, //optional, default 12
                              },
                            },
                          ],
                        },
                        footer: {
                          text: "IBAN: AT69 0100 1010 0101 0011 | SWIFT/BIC: BTVAAT22DOR | Invoice due 2 weeks (10 business days) from the date of generation.",
                        },
                        pageEnable: true,
                        pageLabel: "Page ",
                      };
                      generatePdf();
                    };

                    endPriceRow.appendChild(pdfCol);

                    document.getElementById("orderList").appendChild(a);
                  }
                }
              }
            }
          }
        },
        error: function (response) {
          var x = JSON.parse(response);
          alert(x.status_code + " " + x.message);
        },
      });
    },
  });
  function generatePdf() {
    var pdfCreated = jsPDFInvoiceTemplate.default(props);
    var pdfObject = pdfCreated.jsPDFDocObject;
    pdfObject.output("dataurlnewwindow"); 
  }
});
