var divAllOrders = document.getElementById("myOrders");
var id = null; 




$(document).ready(function() {

    $.ajax({
        type: "GET",
        url: "../../backend/logic/account.php",
        data: {
            
            
            
        },
        async: false,
        
        success: function (response) {


            console.log(response); 
    
            var json = $.parseJSON(response);
            json.forEach(element => {
                id = element.ID; 

                console.log(element.ID);
            });


            console.log(":" + id);



            $.ajax({
                type: "POST",
                url: "../../backend/logic/getMyOrders.php",
                data: {
                    
                    id: id
                    
                },
                async: false,
                
                success: function (response) {
                    //response = list of order where uid = ?
        
                    console.log(response); 
            
                    var json = $.parseJSON(response);
                    json.forEach(element => {


                        var divOrder = document.createElement("div");
                        divOrder.setAttribute("id", "order");
                        divOrder.setAttribute("class", " border border-secondary m-3");
                        divAllOrders.appendChild(divOrder);
                        

                        var orderId = document.createElement("p");
                        divOrder.appendChild(orderId);
                        orderId.innerHTML= element.id; 

                        var orderName = document.createElement("p");
                        divOrder.appendChild(orderName);
                        orderId.innerHTML= element.name; 

                        var orderEmail = document.createElement("p");
                        divOrder.appendChild(orderEmail);
                        orderEmail.innerHTML= element.email; 

                        var orderPhone = document.createElement("p");
                        divOrder.appendChild(orderPhone);
                        orderPhone.innerHTML= element.phone; 

                        var orderAddress = document.createElement("p");
                        divOrder.appendChild(orderAddress);
                        orderAddress.innerHTML= element.address; 
                        



                        //dont know what this is 
                        var orderPmode = document.createElement("p");
                        divOrder.appendChild(orderPmode);
                        orderPmode.innerHTML= element.pmode; 

                        //----

                        var orderProducts = document.createElement("p");
                        divOrder.appendChild(orderProducts);
                        orderProducts.innerHTML= element.products; 

                        var orderAmount = document.createElement("p");
                        divOrder.appendChild(orderAmount);
                        orderAmount.innerHTML= element.amount_paid; 

                        var linkpdf = document.createElement("button");
                        divOrder.appendChild(linkpdf);
                        linkpdf.innerHTML="show pdf";
                        linkpdf.setAttribute("onclick", "generatePdf()");


                        console.log(element.name);
                    });
        
                    
                },
                error: function (response) {
                    console.log("failed");
                    var x = JSON.parse(response);
                    alert(x.status_code + " " + x.message);
                }
            });

            
        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });

});

var props = {
    outputType: jsPDFInvoiceTemplate.OutputType.Save,
    returnJsPDFDocObject: true,
    fileName: "Invoice 2021",
    orientationLandscape: false,
    compress: true,
    logo: {
        src: "../../backend/image/logo-clothing-gs.png",
        type: 'PNG', //optional, when src= data:uri (nodejs case)
        width: 53.33, //aspect ratio = width/height
        height: 26.66,
        margin: {
            top: 0, //negative or positive num, from the current position
            left: 0 //negative or positive num, from the current position
        }
    },
    stamp: {
        inAllPages: true, //by default = false, just in the last page
        src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
        type: 'JPG', //optional, when src= data:uri (nodejs case)
        width: 20, //aspect ratio = width/height
        height: 20,
        margin: {
            top: 0, //negative or positive num, from the current position
            left: 0 //negative or positive num, from the current position
        }
    },
    business: {
        name: "Clothing-Gs GmbH",
        address: "Hochstädterplatz 6, 1200 Wien, Österreich",
        phone: "+43 676 123123123",
        email: "clothing-gs@webshop.com",
        email_1: "info@clothing-gs.at",
        website: "www.example.al",
    },
    contact: {
        label: "Invoice issued for:",
        name: "Client Name",
        address: "Albania, Tirane, Astir",
        phone: "(+355) 069 22 22 222",
        email: "client@website.al",
        otherInfo: "www.website.al",
    },
    invoice: {
        label: "Invoice #: ",
        num: 19,
        invDate: "Payment Date: 01/01/2021 18:12",
        invGenDate: "Invoice Date: 02/02/2021 10:17",
        headerBorder: false,
        tableBodyBorder: false,
        header: [
          {
            title: "#", 
            style: { 
              width: 10 
            } 
          }, 
          { 
            title: "Title",
            style: {
              width: 30
            } 
          }, 
          { 
            title: "Description",
            style: {
              width: 80
            } 
          }, 
          { title: "Price"},
          { title: "Quantity"},
          { title: "Unit"},
          { title: "Total"}
        ],
        table: Array.from(Array(10), (item, index)=>([
            index + 1,
            "There are many variations ",
            "Lorem Ipsum is simply dummy text dummy text ",
            200.5,
            4.5,
            "m2",
            400.5
        ])),
        additionalRows: [{
            col1: 'Total:',
            col2: '145,250.50',
            col3: 'ALL',
            style: {
                fontSize: 14 //optional, default 12
            }
        },
        {
            col1: 'VAT:',
            col2: '20',
            col3: '%',
            style: {
                fontSize: 10 //optional, default 12
            }
        },
        {
            col1: 'SubTotal:',
            col2: '116,199.90',
            col3: 'ALL',
            style: {
                fontSize: 10 //optional, default 12
            }
        }],
        invDescLabel: "Invoice Note",
        invDesc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
    },
    footer: {
        text: "The invoice is created on a computer and is valid without the signature and stamp.",
    },
    pageEnable: true,
    pageLabel: "Page ",
};




function generatePdf( ){
    var pdfCreated = jsPDFInvoiceTemplate.default(props);
    var newCraft = pdfCreated;
    var blob = pdfCreated;
    console.log(typeof(newCraft)); //let you have 'blob' here
    /*var blobUrl = URL.createObjectURL(blob);

    var link = document.createElement("a"); // Or maybe get it from the current document
    link.href = blobUrl;
    link.download = "image.jpg";
    link.innerHTML = "Click here to download the file";
    document.body.appendChild(link);*/
    var pdfObject = pdfCreated.JsPDFDocObject;

    var formData = new FormData();
   // formData.append("pdf", bl);

    
    $.ajax({
        type: "POST",
        url: "../../backend/logic/uploadPdf.php",
        processData: false,
        contentType: false,
        data: {
            
           id: orderId.value,
           
            
        },
        async: false,
        
        success: function (response) {
            //response = list of order where uid = ?

            console.log(response); 
    
            

            
        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });
    

 };