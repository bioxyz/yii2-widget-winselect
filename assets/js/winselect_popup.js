function closePopup() {
    var closePopup = window.opener.get_close_popup();
    if (closePopup) {
         window.close();
    }
}
function replaceHTMLChars(value){
    return value.replace(/&amp;/gi,'&')
            .replace(/&lt;/gi,'<')
            .replace(/&gt;/gi,'>')
            .replace(/&#039;/gi,'\'')
            .replace(/&quot;/gi,'"');
}

function confirmDialog(arrayContents, formName) {
      return -1;
}

function send_back(module, id) {
    var associated_row_data = associated_javascript_data[id];
    eval("var temp_request_data = " + window.document.forms['data_storage_form'].popupwin_input_data.value);
    var request_data = temp_request_data;
    
    var form_name = request_data.form_name;
    var property_field_mapping = request_data.property_field_mapping;
    var call_back_function = eval("window.opener." + request_data.call_back_function);

    var array_contents = Array();
    var fill_array_contents = function(the_key, the_field) {
        var the_value = '';
        if (module != '' && id != '') {
            the_value = associated_row_data[the_key.toLowerCase()];
        }
        if (typeof(the_value) == 'string') {
            the_value = the_value.replace(/\r\n|\n|\r/g, '\\n');
        }
        array_contents.push('"' + the_field + '":"' + the_value + '"');
    }
    for (var the_property in property_field_mapping) {
        if (the_property != 'toJSON') {
            if (Array.isArray(property_field_mapping[the_property])) {
                for (var i = 0; i < property_field_mapping[the_property].length; i++) {
                    fill_array_contents(the_property, property_field_mapping[the_property][i]);
                }
            } else {
                fill_array_contents(the_property, property_field_mapping[the_property]);
            }
        }
    }
    
    var popupConfirm = confirmDialog(array_contents, form_name);
    eval("var name_to_value_array = {" + array_contents.join(",") + "}");
    closePopup();
    var result_data = {
        "form_name": form_name,
        "name_to_value_array": name_to_value_array,
        "popupConfirm": popupConfirm
    };

    call_back_function(result_data);
}