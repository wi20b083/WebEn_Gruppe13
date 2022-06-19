$(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
        console.log("qty change start");
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      console.log(pid + " " + qty + " " + pprice);
      $.ajax({
        url: '../../backend/logic/action.php',
        method: 'post',
        cache: false,
        async: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
        }
      });
      location.reload(true);
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: '../../backend/logic/action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });