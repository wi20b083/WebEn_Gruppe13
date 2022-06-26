//getting Elements
var formId = document.getElementById("pid");
var formName = document.getElementById("pname");
var formPrice = document.getElementById("pprice");
var formQty = document.getElementById("pqty");
var formCode = document.getElementById("pcode");
var formCategory = document.getElementById("pcategory");
var formImg = document.getElementById("pimgEdit");
var imgSrc = document.getElementById("imgSrc");
var imgOfProd =document.getElementById("imgProd");
var formButton = document.getElementById("buttonSave");
var theform = document.getElementById("formEditProduct");

//hide edit Form for the product which we is wanted to be edited 
theform.hidden =true; 

//setting function 
formButton.setAttribute("onclick", "updateProduct()");
//hide current image and display when admin press on edit Product 
imgOfProd.hidden=true;
    

//document ready function - when document is finished loading 
$(document).ready(function() {
    
    $.ajax({
        type: "GET",
        url: "../../backend/logic/index.php",
        data: {
            
            method: "all"
            
        },
        async: false,
        
        success: function (response) {
            console.log(response); 
    
            

            //creating a table where the elements willl be displayed 
                var table = document.getElementById("productTable");
            
                var json = $.parseJSON(response);
                json.forEach(element => {

                var newTr = document.createElement("tr");
                table.appendChild(newTr);
            
                var entryId = document.createElement("td");
                entryId.innerHTML = element.id; 
                newTr.appendChild(entryId);

                var entryName = document.createElement("td");
                entryName.innerHTML = element.product_name; 
                newTr.appendChild(entryName);

                var entryPrice = document.createElement("td");
                entryPrice.innerHTML = element.product_price; 
                newTr.appendChild(entryPrice);

                var entryCode = document.createElement("td");
                entryCode.innerHTML = element.product_code; 
                newTr.appendChild(entryCode);

                var entryCategory = document.createElement("td");
                entryCategory.innerHTML = element.product_category; 
                newTr.appendChild(entryCategory);

                var entryAction = document.createElement("td"); 

                var editButton = document.createElement("button");
                editButton.setAttribute("class", "btn btn-success m-1");
                editButton.innerHTML = "Edit";
                //adding onclick attribute to trigger edit function
                editButton.setAttribute("onclick", "editProduct(" + element.id +" )");
                
                entryAction.appendChild(editButton);

                var deleteButton = document.createElement("button");
                deleteButton.setAttribute("class", "btn btn-danger m-1");
                deleteButton.innerHTML = "Delete";
                //adding onclick attribute to trigger the delete function 
                deleteButton.setAttribute("onclick", "deleteProduct(" + element.id +" )");
                
                entryAction.appendChild(deleteButton);
                newTr.appendChild(entryAction)


            });

        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });


});


function editProduct(id){
    console.log(id); 
    $.ajax({
        type: "POST",
        url: "../../backend/logic/productEdit.php",
        data: {
            
            id: id,
            
        },
        async: false,
        
        success: function (response) {
            console.log(response); 
            
            
            
            //show form and Img of product 
            form.hidden=false;
            imgOfProd.hidden=false;
            

            var json = $.parseJSON(response);
                //setting the value in the form for the selected 
            json.forEach(element => {
                formId.value = element.id;
                formName.value = element.product_name;
                formPrice.value = element.product_price;
                
                formCode.value = element.product_code;
                //load img from directory
                imgOfProd.setAttribute("src", "../../backend/" + element.product_image);
                imgSrc.value = element.product_image;
                //option index for the option value 
                var optionIndex; 

        
                var category = element.product_category;

                //setting option index 
                if(category == "Shirt"){
                    optionIndex = 0; 
                }else if(category == "Pullover"){
                    optionIndex = 1;
                }else if(category == "Hose"){
                    optionIndex = 2; 
                }
                //setting value of the option element
                formCategory.selectedIndex = optionIndex;
            

        

            });



            

    
    
        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });




}
//delete function 
function deleteProduct(id){
    $.ajax({
        type: "POST",
        url: "../../backend/logic/deleteProduct.php",
        data: {
            
            id: id,
            
        },
        async: false,
        
        success: function (response) {
            console.log(response);
            
            //relocating after successfully deleting the item
            alert("Produkt wurde gelöscht. ")
            location.reload(); 

    
        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });
}

//function to update the prodcut 
function updateProduct(){

     


    $.ajax({
        type: "POST",
        url: "../../backend/logic/updateProduct.php",
        data: {
            
            id: formId.value.trim(),
            pname: formName.value.trim(),
            pprice: formPrice.value.trim(),
            pimg: formImg.value.trim(),
            pcode: formCode.value.trim(),
            pcategory: formCategory.value.trim(),
            imgSrc: imgSrc.value.trim()
            


            
        },
        async: false,
        
        success: function (response) {
            console.log(response);
            
            window.location=("../sites/editSingleProduct.php");
            alert(response);

    
        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });
    
   

    



}
