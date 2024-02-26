
function removeMainOption(divSection){
    var section = document.getElementById(divSection);
    section.remove();
 }

 function removeOptionValue(tr){
    var tr = document.getElementById(tr);
    tr.remove();
 }

 function editOptionValue(option_value, option_qty, price, row_id){ 
    var option_id = document.getElementById('product_option_id').value;
    var modal = document.getElementById('edit_product_modal');  
    var optionVal = document.getElementById('modal_option_value');
    var selectedOption = optionVal.options[optionVal.selectedIndex];
    var dataId = selectedOption.getAttribute('data-id'); 
 

    var inputs = modal.querySelectorAll('input[type="number"]');  
    inputs.forEach(function(input){
    input.value = '';
    }); 
    var option_modal = document.getElementById('edit_modal_option_value');
    var option_list ='';
   
    $.ajax({
        url: optionValueListRoute,
        data: {'id':option_id}, 
        type: "GET",
        success:function(response){
            response.data.forEach(function(item){
                var select_status = ''; 
                if (item.id === option_value) {
                    select_status = 'selected'; 
                }  
               option_list += `<option value="${item.name}" data-id="${item.id}" ${select_status}>${item.name}</option>`
            });
            option_modal.innerHTML = option_list;
        } 
    });
    var product_qty = document.getElementById('edit_product_qty');
    product_qty.value=option_qty;
    var edit_row_id = document.getElementById('edit_row_id');
    edit_row_id.value=row_id;
    
    var priceArr = price.split(",");
    priceArr.forEach(function(element, index){ 
        var priceInput = document.getElementById('edit_price_'+(index+1));
        // if (priceInput) {
        //     priceInput.value = element.trim();
        // }
        priceInput.value = element;  
    }); 
 }

 function validateEditOptionModal(){ 
    var edit_option_modal = document.querySelector('.edit_option_modal'); 
    var all_errors = edit_option_modal.querySelectorAll('p.input_error');
    all_errors.forEach(function(error_p){
        error_p.innerHTML = "";
    });

    var product_qty = document.getElementById('edit_product_qty').value;
    if(product_qty <= 0 || product_qty == ''){
        document.getElementById('edit_qty_error').innerHTML = "Quantity is required.";
        document.getElementById('edit_product_qty').focus();
        return false;
    }  

    for(var i = 1; i <= 12; i++){
        var edit_price = document.getElementById('edit_price_'+i).value;
        if(edit_price <= 0 || edit_price == ''){
            document.getElementById('edit_price_'+i+'_error').innerHTML = "Price is required.";
            document.getElementById('edit_price_'+i).focus();
            return false;
        }
}
   
 
        var optionVal = document.getElementById('edit_modal_option_value');
        var selectedOption = optionVal.options[optionVal.selectedIndex];
        var dataId = selectedOption.getAttribute('data-id'); 
        var product_qty = document.getElementById('edit_product_qty').value; 
        var edit_row_id = document.getElementById('edit_row_id').value;
        var prices = [];
            $('input[name="edit_price[]"]').each(function() {
                prices.push($(this).val());
            });
            var html_to_append = `<td>${optionVal.value}
             <input type="hidden" name="option_value[]" value="${dataId}"> 
             </td>
            <td>${product_qty}
            <input type="hidden" name="option_qty[]" value="${product_qty}"> 
            </td>  
            <td style="text-align:end">
            <i class="fa fa-minus-circle" aria-hidden="true" onclick="removeOptionValue('${edit_row_id}')"></i>
            <i class="fa fa-pencil-square mx-2" data-toggle="modal" data-target="#edit_product_modal" onclick="editOptionValue(${dataId}, ${product_qty}, '${prices}', '${edit_row_id}')"></i>
            </td> 
            <input type="hidden" value="${prices}" id="price_list" name="price_list">`; 
            var  append_tr = document.getElementById(edit_row_id);
            append_tr.innerHTML = html_to_append;
            
            var modal = document.getElementById('edit_product_modal');  
            var inputs = modal.querySelectorAll('input[type="number"]');  
            inputs.forEach(function(input){
                input.value = '';
            });  
            $('#edit_product_modal').modal('hide');
 }
 

 $(document).ready(function () {
    $('.aiz-date-range').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        showMeridian: true,
        forceParse: false,
        minuteStep: 1,
        startDate: new Date()
    });
});

function calculate() {
    var amount = parseFloat(document.getElementById('amount').value);
    var vatRate = parseFloat(document.getElementById('vatRate').value);
    var taxRate = parseFloat(document.getElementById('taxRate').value);
    if (isNaN(amount) || isNaN(vatRate) || isNaN(taxRate)) {
        alert('Please enter valid numeric values.');
        return;
    }
    var vatAmount = (amount * vatRate) / 100;
    var taxAmount = (amount * taxRate) / 100;
    var totalAmount = amount + vatAmount + taxAmount;
    var resultHTML = '<h4>Result:</h4>' +
        '<p>VAT Amount: ₹' + vatAmount.toFixed(2) + '</p>' +
        '<p>Tax Amount: ₹ ' + taxAmount.toFixed(2) + '</p>' +
        '<p>Total Amount (including VAT and Tax): ₹ ' + totalAmount.toFixed(2) + '</p>';
    document.getElementById('result').innerHTML = resultHTML;
}



function checkAllBox(main, sub) {
    var mainCheckboxs = document.getElementById(main);
    var subCheckboxes = document.querySelectorAll('.' + sub);
    for (var i = 0; i < subCheckboxes.length; i++) {
        subCheckboxes[i].checked = mainCheckboxs.checked;
    }
}
function removeAllCheckBox(main, sub) {
    var mainCheckboxs = document.getElementById(main);
    var subCheckboxes = document.querySelectorAll('.' + sub + ':checked');
    if (subCheckboxes.length > 0) {
        mainCheckboxs.checked = true;
    } else {
        mainCheckboxs.checked = false;
    }
}
function showOptions(event, option, show, hide) {
    event.preventDefault();
    const subCatList = document.getElementById(option);
    const showBtn = document.getElementById(show);
    const hideBtn = document.getElementById(hide)
    showBtn.style.display = "none";
    hideBtn.style.display = "inline"
    if (subCatList.style.display = "none")
        subCatList.style.display = "block";
}
function hideOptions(event, option, show, hide) {
    event.preventDefault();
    const subCatList = document.getElementById(option);
    const showBtn = document.getElementById(show);
    const hideBtn = document.getElementById(hide)
    showBtn.style.display = "inline";
    hideBtn.style.display = "none"
    if (subCatList.style.display = "block")
        subCatList.style.display = "none";
} 


$(document).on('change', '#product_option_name', function () { 
    var selected_id = $(this).val();  
    var optionVal = document.getElementById('product_option_name');
    var selectedOption = optionVal.options[optionVal.selectedIndex];
    var dataName = selectedOption.getAttribute('data-name'); 
    var html_to_append = `<div id="append_table_div_${selected_id}" class="w-100">
    <input type="hidden" name="product_option_id" id="product_option_id" value="${selected_id}">
    <i class="fa fa-minus-circle product-option-add-btn" aria-hidden="true" onclick="removeMainOption('append_table_div_${selected_id}')"></i>
    <div class="append_table">
     <p class="table_tag"><b>${dataName}</b></p>  
     </div> 
    <table class="product-option" id="option_table_${selected_id}">
                                    <thead>
                                        <tr>
                                            <th>Option Value</th>
                                            <th>Quantity</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                    </tbody>
                                </table>  
                             <i class="fa fa-plus-circle product-option-add-btn" data-toggle="modal" data-target="#product_modal" onclick="showOptionModal('option_table_${selected_id}', ${selected_id})"></i>
                             </div>`;
    document.getElementById('option_list_row').innerHTML = html_to_append;
});