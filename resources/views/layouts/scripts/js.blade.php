<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/countdown.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            autoplay: false,
            autoplayTimeout: 3000,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                1014: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1600: {
                    items: 1
                }
            }
        });

    });
</script>

<script>
    //ajax call to handle subscription
    function subscribe_me() {
        $.ajax({
            type:'POST',
            url:"{{ route('subscribe') }}",
            data:{
                _token : "{{ csrf_token() }}",
                email : $('#news_email').val()
            },

            success:function(data) {
//                console.log(data);
                if(data.success){
                    $(".subscriber").show();
                    $('#news_email').val("");
                }

            }
        });
    }

    //ajax function to load all images
    $(document).ready(function(){
        inloadImage()
        $('.carousel').carousel()
    });

    function inloadImage() {
        let frames = $('.load_image');
        if(frames.length > 0){
            //start proceedure
            $.each(frames, function (int, frame) {
                let imgUrl = $(frame).data('img_link');
//                console.log(imgUrl);
                $(frame).attr('src', imgUrl);
                //remove class
                $(frame).removeClass('load_image');
            })
        }
    }

    function removeFromCart(url, uuid) {
        $.ajax({
            type:'GET',
            url: url,
            data:{
                _token : "{{ csrf_token() }}",
            },

            success:function(data) {
                console.log(data);
                if(data.success){

                    updateCart(data.product, 'remove')
                }

            }
        });
    }

    function addToCart(url, btn) {
        $.ajax({
            type:'GET',
            url: url,
            data:{
                _token : "{{ csrf_token() }}",
            },

            success:function(data) {
                console.log(data);
                if(data.success){
//                    $('.'+btn).text('Added');
                    $('.'+btn).css({'background-color':'green', 'color':'white'});
                    $('.no_item').hide();
                    updateCart(data.product, 'add')
                }

            }
        });
    }

    function addToWish(url, span) {
        $.ajax({
            type:'POST',
            url: url,
            data:{
                _token : "{{ csrf_token() }}",
            },

            success:function(data) {
                console.log(data);
                if(data.success){
                    $('.'+span).text(data.message);
                }
            }
        });
    }

    function addValToCart(url, btn) {
        let qty = $('#singleOrderVal').val();
        url = url+"?item_qty="+qty;
        $.ajax({
            type:'GET',
            url: url,
            data:{
                _token : "{{ csrf_token() }}",
            },

            success:function(data) {
                console.log(data);
                if(data.success){
                    $('.'+btn).text('Added');
                    $('.no_item').hide();
                    updateCart(data.product, 'add')
                }

            }
        });
    }

    function updateCart(product, flow) {
        let listElem = $('.shopping-list');
        let totalPriceElem = $('.total-amount');
        let itemCount = $('.cart_item_count');
        let ttprice = formatNumber(product.total_price);
        if(flow==='add'){
            let prodE = `<li class='cart_item_${product.uuid}'><a href='#' onclick="event.preventDefault(); removeFromCart('${product.remove_url}', '${product.uuid}')" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                <a class="cart-img" href="#"><img src="${product.img_url}" alt="#"></a>
                <h4><a href="#">${product.name}</a></h4>
                <p class="quantity">${product.qty}x  - <span class="amount">N${ttprice} </span></p></li>`;
            listElem.append(prodE);
            let oldPrice = parseFloat(totalPriceElem.attr('data-value'));
            console.log(oldPrice , 'old price')
            let totalPrice = oldPrice+product.price;
            totalPriceElem.text("N"+formatNumber(totalPrice));
            totalPriceElem.attr('data-value', totalPrice);
            let totalItems = product.total_items;
            itemCount.text(totalItems+' Items');
            itemCount.attr('data-value', totalItems)
            $('.total-count').text(totalItems);
        }else{
            let oldPrice = parseFloat(totalPriceElem.attr('data-value'));
            let totalPrice = oldPrice - product.total_price;
            totalPriceElem.text("N"+formatNumber(totalPrice));
            totalPriceElem.attr('data-value', totalPrice);
            let totalItems = product.total_items;
            itemCount.text(totalItems+' Items');
            itemCount.attr('data-value', totalItems);
            $('.total-count').text(totalItems);

            let cartItem = $('.cart_item_'+product.uuid);
            cartItem.remove();
            $('.btn_'+product.uuid).text('Add to Cart');
        }

    }

    function updateQty(url) {
        $.ajax({
            type:'GET',
            url: url,
            data:{
                _token : "{{ csrf_token() }}",
            },

            success:function(data) {
                console.log(data);
                if(data.success){
                    updateItem(data.product)
                }

            }
        });
    }

    function updateItem(product) {
        let field = $('.item_qty_'+product.uuid);
        let cartTotalAmount = $('.total-amount');
        let itemTotalPrice = $('.item_total_price_'+product.uuid);
        field.val(product.qty);
        itemTotalPrice.text("N"+formatNumber(product.total_price));
        cartTotalAmount.attr('data-value', product.cart_subtotal);
        cartTotalAmount.text("N"+formatNumber(product.cart_subtotal));

    }

    function formatNumber(num) {
        num = num.toFixed(2);
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function deleteThis(link) {
        var answer = prompt("Are you sure you want to delete this selection?");
        if (answer === "yes") {
            console.log('you said yes')
            window.location.href = link;
        }else{
            console.log('you said no')
        }
    }

    function isNumberKey(evt) {
            let k = evt.key;
            if(isNaN(k) ){
                return false;
            }else{
                return true;
            }

//        var charCode = (evt.which) ? evt.which : evt.keyCode;
//        console.log(charCode);
//        return !(charCode > 31 && (charCode < 46 || charCode > 57 || charCode === 47 ));
//            return !(charCode > 31 && (charCode < 46 || charCode > 57 ));
    }
</script>
