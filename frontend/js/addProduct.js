//Getting Form Elements

var pname = document.getElementById("pname");
var pprice = document.getElementById("pprice");
//var pqty = document.getElementById("pqty");
var pcode = document.getElementById("pcode");
var pcategory = document.getElementById("pcategory");
var pimg = document.getElementById("pimg");
var buttonAdd = document.getElementById("buttonAdd");


//add on click listener 
buttonAdd.setAttribute("onClick", "addProduct()");


//function which makes the call to the backend --> onclick 
function addProduct() {

    //posts the call to the backend 
    $.ajax({
        type: "POST",
        url: "../../backend/logic/addProductToDb.php",
        data: {
            
            //data 
            pname: pname.value.trim(),
            pprice: pprice.value.trim(),    
            //pqty: pqty.value.trim(),
            pcode: pcode.value.trim(),
            pcategory: pcategory.value.trim(),
            pimg: pimg.value.trim(),
            
        },
        async: false,
        
        success: function (response) {

            console.log(response); 
            
            alert("Product wurde hinzugefügt")
            //window.location("../../frontend/sites/newProduct.php");
            



        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });

    
}






pimg.setAttribute("onChange", "logResult()")






function logResult(){
    console.log(pname.value.trim() + " " +  pimg.value.trim() + " " + pcategory.value.trim() + " " +  pprice.value.trim() + " " + pcode.value.trim() + " " );
}


