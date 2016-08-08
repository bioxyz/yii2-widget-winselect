if(window.document.forms['data_storage_form'] != null 
        && typeof(window.document.forms['data_storage_form'].popupwin_input_data) != 'undefined')
{
    if (window.document.forms['data_storage_form'].popupwin_input_data.value == "") {
        window.document.forms['data_storage_form'].popupwin_input_data.value = window.opener.get_popupwin_input_data();
    } 
}