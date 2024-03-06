  
// ------------------------------- select option ---------------------------------------
    document.addEventListener('DOMContentLoaded', function() {
        let radioButtons = document.querySelectorAll('.cap-btns input[name="option_value"]');
        let month = 1; 
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('click', function(){
                let product_id = document.getElementById("product_id").value;
                let option_value_id = document.querySelector('input[name="option_value"]:checked').value;
            $.ajax({
            url: baseUrl+"/single-product/get-month-price",
            type: "GET", 
            data: {"product_id": product_id, "option_value_id": option_value_id},
            success: function(response) {
                if(month == 1){
                    $('#price').val(response.data.price_1); 
                    document.getElementById('show_price').innerHTML = response.data.price_1; 
                    $('#slider').val(1); 
                    $('#month').val(1); 
                } 
            }
            });
            });
        });
    }); 
// ------------------------------- select option ---------------------------------------

// ------------------------------- update month slider ------------------------------------
    const slider = document.getElementById('slider');
    const numbers = document.querySelectorAll('.number');
    slider.addEventListener('input', function() {
        const month = parseInt(this.value);
        let option_value = document.querySelector('input[name="option_value"]:checked').value;  
        let product_id = document.getElementById("product_id").value;
        let option_value_id = document.querySelector('input[name="option_value"]:checked').value;
        $.ajax({
            url: baseUrl+"/single-product/get-month-price",
            type: "GET", 
            data: {"product_id": product_id, "option_value_id": option_value_id},
            success: function(response) {
                if(month == 1){
                    $('#price').val(response.data.price_1); 
                    $('#month').val(1); 
                    document.getElementById('show_price').innerHTML = response.data.price_1; 
                }else if(month == 2){
                    $('#price').val(response.data.price_2);
                    $('#month').val(2); 
                    document.getElementById('show_price').innerHTML = response.data.price_2;
                }else if(month == 3){
                    $('#price').val(response.data.price_3); 
                    $('#month').val(3); 
                    document.getElementById('show_price').innerHTML = response.data.price_3;
                }else if(month == 4){
                    $('#price').val(response.data.price_4); 
                    $('#month').val(4); 
                    document.getElementById('show_price').innerHTML = response.data.price_4;
                }else if(month == 5){
                    $('#price').val(response.data.price_5); 
                    $('#month').val(5); 
                    document.getElementById('show_price').innerHTML = response.data.price_5;
                }else if(month == 6){
                    $('#price').val(response.data.price_6); 
                    $('#month').val(6); 
                    document.getElementById('show_price').innerHTML = response.data.price_6;
                }else if(month == 7){
                    $('#price').val(response.data.price_7); 
                    $('#month').val(7); 
                document.getElementById('show_price').innerHTML = response.data.price_7;
                }else if(month == 8){
                    $('#price').val(response.data.price_8); 
                    $('#month').val(8); 
                    document.getElementById('show_price').innerHTML = response.data.price_8;
                }else if(month == 9){
                    $('#price').val(response.data.price_9); 
                    $('#month').val(9); 
                    document.getElementById('show_price').innerHTML = response.data.price_9;
                }else if(month == 10){
                    $('#price').val(response.data.price_10); 
                    $('#month').val(10); 
                    document.getElementById('show_price').innerHTML = response.data.price_10;
                }else if(month == 11){
                    $('#price').val(response.data.price_11); 
                    $('#month').val(11); 
                    document.getElementById('show_price').innerHTML = response.data.price_11;
                }else if(month == 12){
                    $('#price').val(response.data.price_12); 
                    $('#month').val(12); 
                    document.getElementById('show_price').innerHTML = response.data.price_12;
                } 
            }
        });  
    }); 
// ------------------------------- update month slider ------------------------------------

// ------------------------------- datepicker ---------------------------------------
    var datePicker = document.getElementById("delivery_date");
    function setMinMaxAttributes(){
        var today = new Date().toISOString().split("T")[0];
        datePicker.setAttribute("min", today);
    } 
    setMinMaxAttributes(); 
// ------------------------------- datepicker ---------------------------------------

// ------------------------------- product image ---------------------------------------
    const thumbnailWrapper = document.querySelector(".thumbnail");
    const mainImage = document.querySelector(".mainImage");
    mainImage.addEventListener("mousemove", (e) =>{
        const containerWidth = mainImage.offsetWidth;
        const containerHeight = mainImage.offsetHeight;
        const image = mainImage.querySelector("img");
        const imageWidth = image.offsetWidth;
        const imageHeight = image.offsetHeight;
        const x = e.pageX - mainImage.offsetLeft;
        const y = e.pageY - mainImage.offsetTop;
        const translateX = (containerWidth / 2 - x) * 2;
        const translateY = (containerHeight / 2 - y) * 2;
        const scale = 3;
        image.style.transform = `translate(${translateX}px, ${translateY}px) scale(${scale})`;
    });
    mainImage.addEventListener("mouseleave", (e) =>{
        const image = mainImage.querySelector("img");
        image.style.transform = "translate(0%, 0%) scale(1)";
    });

    thumbnailWrapper.querySelectorAll(".thumbnailBox").forEach((thumbnail) =>{
        thumbnail.addEventListener("click", (e) =>{
            const activeThumbnail = document.querySelector(".thumbnailBox.active");
            if (activeThumbnail){
                activeThumbnail.classList.remove("active");
            }
            thumbnail.classList.add("active");
            imageSrc = thumbnail.querySelector("img").getAttribute("src");
            mainImage.innerHTML = `<img src="${imageSrc}" alt="">`;
        });
    }); 

// ------------------------------- product image ---------------------------------------

// ------------------------------- rating ---------------------------------------
    const ratingInputs = document.querySelectorAll('input[name="rating"]');
    ratingInputs.forEach(input =>{
        input.addEventListener('click', function (){
            const clickedValue = parseInt(this.value);
            ratingInputs.forEach(input =>{
                const inputValue = parseInt(input.value);
                if (inputValue <= clickedValue){
                    input.checked = true;
                } else{
                    input.checked = false;
                }
            });
        });
    });
// ------------------------------- rating ---------------------------------------

// ------------------------------- cart button ---------------------------------------
$(document).on('click', '#add_to_cart_btn', function(){  
    let product_id = $('#product_id').val(); 
    let delivery_date = $('#delivery_date').val(); 
    let quantity = $('#quantity').val(); 
    let option_value_id = document.querySelector('input[name="option_value"]:checked').value;
    let month = $('#month').val(); 
    let price = $('#price').val();  
    $("#quantity_error").html("");
    $("#date_error").html("");
    
    $.ajax({
        url:baseUrl+"/verify-user",
        type: "GET", 
        success:function(response){ 
            if(delivery_date == ''){
                $("#date_error").html("Please select date."); 
                return false;
            }
            if(quantity == 0){
                $("#quantity_error").html("Quantity can't be zero."); 
                return false;
            }
                 $.ajax({
                    url:baseUrl+"/add-to-cart",
                    type:"GET",
                    data: 
                    {
                        'product_id':product_id,
                        'delivery_date':delivery_date,
                        'quantity':quantity,
                        'option_value_id':option_value_id,
                        'month':month,
                        'price':price,
                        'authentication': response.authentication
                    },
                    success:function(response){
                        console.log(response);
                        let item_count = response.data.length; 
                        $('#cartItemCount').html(item_count);
                        let update_btn_text = $('#add_to_cart_btn'); 
                        update_btn_text.html("Added"); 
                        update_btn_text.addClass("add_to_cart_btn_success");
                        
                        // Show SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Added to Cart',
                            text: 'The item has been successfully added to your cart.',
                        });
                        
                    }
                 });
        }
    })
});
// ------------------------------- cart button ---------------------------------------

async function updateCart() {
    try {
        let product_id = document.getElementById("product_id").value;

        const response = await fetch(baseUrl + "/verify-user");
        const userData = await response.json();

        if (userData.authentication === true) {
            const productResponse = await fetch(baseUrl + "/check-product-in-cart?product_id=" + product_id);
            const productData = await productResponse.json();

            if (productData.product_status === "already_exist") {
                document.getElementById('add_to_cart_btn').innerHTML = 'Update Cart';
                document.getElementById('add_to_cart_btn').classList.remove("add_to_cart_btn_success");
            }
        } else {
            console.log('logged out');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function checkStock(){
try {
    let product_id = $("#product_id").val(); 
    let quantity = parseInt($("#quantity").val());  
    let option_value_id = document.querySelector('input[name="option_value"]:checked').value; 
    const response = await fetch(baseUrl+"/check-stock?product_id="+product_id+"&quantity="+quantity+"&option_value_id="+option_value_id)
    if (response.ok) {
        const data = await response.json();
        if (data.quantity < quantity || data.quantity == 0) {
            $('#add_to_cart_btn').prop('disabled', true);
            $('#add_to_cart_btn').html('Out of Stock');
            $("#stock_status").html("Out Of Stock");
            $("#stock_status").removeClass("text-success");
            $("#stock_status").addClass("text-danger");
            $("#add_to_cart_btn").addClass("text-danger");
        } else {
            $('#add_to_cart_btn').prop('disabled', false);
            $("#stock_status").html("In Stock");
            $("#stock_status").removeClass("text-danger");
            $("#stock_status").addClass("text-success");
        }
    } else {
        console.log(response.status);
        console.error('Failed to fetch data from server');
    }
     
}catch(error){
    console.log("Erro: ", error);
}
}


$(document).on("change", "#delivery_date", async function ()
{
    await updateCart();
});
$(document).on("change", "#quantity", async function ()
{
    await  updateCart();
    await checkStock();
});
$(document).on("change", "#option_value_radio", async function ()
{
    await updateCart();
    await checkStock();
});
$(document).on("change", "#range_slider_section", async function ()
{
    await updateCart();
});
