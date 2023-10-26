
    var base_url = 'http://localhost/shop/';
    $(document).on('click', '.add-cart-button', function() {
        var product_id = $(this).attr('data-product-id');
        var quantity = 1; 
        
        $.ajax({
            type: 'POST',
            url: base_url+'products/add_to_cart',
            data: { product_id: product_id, quantity: quantity },
            success: function(response) {
                if (response === 'success') {
                    alert('Product added to cart.');
                } else {
                    alert('Failed to add the product to the cart.');
                }
            }
        });
    });


