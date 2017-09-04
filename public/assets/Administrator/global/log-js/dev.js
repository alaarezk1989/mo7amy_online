$(document).ready(function () {
    //var clipboard = new Clipboard('.item_copy');
    $("body").on('click', '.item_copy', function(event) {
        event.preventDefault();
        /*var clipboard_target_id = $(this).attr('clipboard_target_id');
        var answer_id = $('#'+clipboard_target_id).attr('value');
        var clipboard = new Clipboard('#'+$(this).attr('id'), {
            text: function() {
                return answer_id;
            }
        });    */
        /*var attr_id = $(this).attr('attr-id');
        var answer_id = 'a'+attr_id;
        if (!$('#answer_id_hidden_to_copy').length) {
            $('<input>').attr({
                type: 'hidden',
                id: 'answer_id_hidden_to_copy',
                value: answer_id,
            }).appendTo('body');
        }else{
            $('#answer_id_hidden_to_copy').attr('value', answer_id);            
        }*/
        //copyToClipboard($("#answer_id_hidden_to_copy"));
    });
});
/*function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}*/