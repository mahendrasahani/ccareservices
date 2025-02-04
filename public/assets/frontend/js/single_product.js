  
// ------------------------------- select option ---------------------------------------
    document.addEventListener('DOMContentLoaded', async function() {
        await checkStock();
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
// ------------------------------- select option ------------------------------------------

// ------------------------------- update month slider ------------------------------------
const slider = document.getElementById('slider');
const numbers = document.querySelectorAll('.number');

slider.addEventListener('input', async function ()
{
    const month = parseInt(this.value);
    const option_value = document.querySelector('input[name="option_value"]:checked').value;
    const product_id = document.getElementById("product_id").value;
    const option_value_id = document.querySelector('input[name="option_value"]:checked').value;
    const range_slider_section_color = document.getElementById('range_slider_section')
    try{
        const response = await fetch(`${baseUrl}/single-product/get-month-price?product_id=${product_id}&option_value_id=${option_value_id}`);
        if (!response.ok){
            throw new Error('Network response was not ok');
        }
        const responseData = await response.json();
        let price;
        switch (month){
            case 1:
                slider.disabled = true;
                range_slider_section_color.style.filter = 'blur(1px)'; 
                range_slider_section_color.style.color = '#deecfc'; 
                price = responseData.data.price_1; 
                slider.disabled = false;
                setTimeout(() =>{
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                range_slider_section_color.style.color = ''; 
                break;
            case 2:
                slider.disabled = true;
                range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_2;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 3:
                slider.disabled = true;
                range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_3;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';
                }, 700);
                break;
            case 4:
                slider.disabled = true;
                range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_4;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 5:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_5;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 6:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_6;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 7:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_7;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 8:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_8;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 9:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_9;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 10:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_10;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 11:
                slider.disabled = true;
                range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_11;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            case 12:
                slider.disabled = true;
                 range_slider_section_color.style.filter = 'blur(1px)';
                price = responseData.data.price_12;
                slider.disabled = false;
                setTimeout(() =>
                {
                    slider.disabled = false;
                    range_slider_section_color.style.filter = 'blur(0px)';  
                }, 700);
                break;
            default:
                console.error('Invalid month value');
                return;
        }   

        $('#price').val(price);
        $('#month').val(month);
        document.getElementById('show_price').innerHTML = price;

    } catch (error)
    {
        console.error('There was a problem with the fetch operation:', error);
    }
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
ratingInputs.forEach((input, index) =>
{
    input.addEventListener('click', function ()
    {
        const clickedIndex = Array.from(ratingInputs).indexOf(this);
        ratingInputs.forEach((input, i) =>
        {
            input.checked = i <= clickedIndex;
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
    let stock_id = document.querySelector('input[name="option_value"]:checked').getAttribute('data-stock-id'); 
    console.log(stock_id);
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
                        'stock_id':stock_id,
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
            const productResponse = await fetch(baseUrl + "/check-product-in-cart?product_id=" + product_id);
            const productData = await productResponse.json();

            if (productData.product_status === "already_exist") {
                document.getElementById('add_to_cart_btn').innerHTML = 'Update Cart';
                document.getElementById('add_to_cart_btn').classList.remove("add_to_cart_btn_success");
            } 
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
            $("#number_of_stock").html('('+data.quantity+')');
        if (data.quantity < quantity || data.quantity == 0) {
            $('#add_to_cart_btn').prop('disabled', true);
            $('#add_to_cart_btn').html('Out of Stock');
            $("#stock_status").html("Out Of Stock");
            $("#stock_status").removeClass("text-success");
            $("#stock_status").addClass("text-danger");
            $("#add_to_cart_btn").addClass("bg-danger");
        } else {
            $('#add_to_cart_btn').prop('disabled', false);
            $("#stock_status").html("In Stock");
            $('#add_to_cart_btn').html('Add to cart');
            $("#stock_status").removeClass("text-danger");
            $("#stock_status").addClass("text-success");
            $("#add_to_cart_btn").removeClass("bg-danger"); 
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
    await checkStock();
    await updateCart();
});
$(document).on("change", "#range_slider_section", async function ()
{
    await updateCart();
});
