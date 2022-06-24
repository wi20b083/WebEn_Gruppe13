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
    theform.hidden =true; 
    formButton.setAttribute("onclick", "updateProduct()");
    
    imgOfProd.hidden=true;
    
    
$(document).ready(function() {
    

    /*var formButton = document.getElementById("buttonSave");
    formButton.setAttribute("onclick", "updateProduct()");
    formButton.hidden =true; */
    

    $.ajax({
        type: "GET",
        url: "../../backend/logic/index.php",
        data: {
            
            method: "all"
            
        },
        async: false,
        
        success: function (response) {
            console.log(response); 
    
            
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

                /* var entryQty = document.createElement("td");
                entryQty.innerHTML = element.product_qty; 
                newTr.appendChild(entryQty); */

                var entryCode = document.createElement("td");
                entryCode.innerHTML = element.product_code; 
                newTr.appendChild(entryCode);

                var entryCategory = document.createElement("td");
                entryCategory.innerHTML = element.product_category; 
                newTr.appendChild(entryCategory);

                var editButton = document.createElement("button");
                editButton.innerHTML = "Edit";
                editButton.setAttribute("onclick", "editProduct(" + element.id +" )");
                editButton.setAttribute("class", "m-1");
                newTr.appendChild(editButton);

                var deleteButton = document.createElement("button");
                deleteButton.innerHTML = "Delete";
                deleteButton.setAttribute("onclick", "deleteProduct(" + element.id +" )");
                deleteButton.setAttribute("class", "m-1");
                newTr.appendChild(deleteButton);






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
            
            
            

            form.hidden=false;

            //get Elements of the form 
            //formId.setAttribute("type", "text");
            //formId.setAttribute("readonly", "true");
           // formName.setAttribute("type", "text");
           // formPrice.setAttribute("type", "Number");
           // formQty.setAttribute("type", "Number");
            //formCode.setAttribute("type", "text");
           // formCategory.setAttribute("style", "");
            //formImg.hidden=false;
            imgOfProd.hidden=false;
            //formButton.hidden = false;

            var json = $.parseJSON(response);
                //setting the value in the form for the selected 
            json.forEach(element => {
                formId.value = element.id;
                formName.value = element.product_name;
                formPrice.value = element.product_price;
                //formQty.value = element.product_qty;
                formCode.value = element.product_code;
                imgOfProd.setAttribute("src", "../../backend/" + element.product_image);
                imgSrc.value = element.product_image;
            
                var optionIndex; 

        
                var category = element.product_category;


                if(category == "Shirt"){
                    optionIndex = 0; 
                }else if(category == "Pullover"){
                    optionIndex = 1;
                }else if(category == "Hose"){
                    optionIndex = 2; 
                }
                
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
            
            
            window.location = ("../../frontend/sites/editProducts.php");
            alert("Produkt wurde gelöscht. ")

    
        },
        error: function (response) {
            console.log("failed");
            var x = JSON.parse(response);
            alert(x.status_code + " " + x.message);
        }
    });
}


function updateProduct(){

     


    $.ajax({
        type: "POST",
        url: "../../backend/logic/updateProduct.php",
        data: {
            
            id: formId.value.trim(),
            pname: formName.value.trim(),
            pprice: formPrice.value.trim(),
            //pqty: formQty.value.trim(),
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
