$(document).keydown(function(e){
    var key_left = 37, key_right = 39, key_up = 38, key_down = 40, key_enter = 13;
    switch (e.keyCode) {
        case key_down:
            keyDownPressed();
            break;
        case key_up:
            keyUpPressed();
            break;
        case key_left:
            keyLeftPressed();
            break;
        case key_right:
            keyRightPressed();
            break;
        case key_enter:
            keyEnterPressed();
            break;
    }
});

function getCategory() {
    return document.getElementsByClassName("nav-item active")[0].textContent.trim().toLowerCase();
}

function getNode() {
    return document.getElementById(getCategory());
}

function setPositionFirstRow() {
    if (getNode().getElementsByClassName("content-row").length > 0) {
        $(getNode().getElementsByClassName("content-row")[0]).addClass('row-selected');
        $(getNode().getElementsByClassName("content-row")[0].getElementsByTagName("TD")[0]).addClass('col-selected');
    } else {
        $($(getNode()).find('.add')).addClass('add-selected');
    }
}

function setPositionLastRow() {
    if (getNode().getElementsByClassName("content-row").length > 0) {
        $(getNode().getElementsByClassName("content-row")[getNode().getElementsByClassName("content-row").length - 1]).addClass('row-selected');
        $(getNode().getElementsByClassName("content-row")[getNode().getElementsByClassName("content-row").length - 1].getElementsByTagName("TD")[0]).addClass('col-selected');
    }
}

function isRowSelected(row) {
    return (row.className.split(" ")[2] === 'row-selected' ? true : false);
}

function isRowsSelected() {
    return ($(getNode()).find('.row-selected').length > 0 ? true : false);
}

function isColSelected(col) {
    return (col.className.split(" ")[1] === 'col-selected' ? true : false);
}

function isNavItemActive(navItem) {
    return (navItem.className.split(" ")[1] === 'active' ? true : false);
}

function isAddSelected() {
    return ($(getNode()).find('.add-selected').length > 0 ? true : false);
}

function isModSelected() {
    return ($(getNode()).find('.mod-selected').length > 0 ? true : false);
}

function isNavSelected() {
    return ((isAddSelected() || isRowsSelected() || isModSelected()) ? false : true);
}

function setPositionNextRow() {
    var selected_row = $(getNode()).find('.row-selected')
    var next_row     = $(selected_row).next('tr');
    var selected_col = $(selected_row).find('.col-selected');
    $(selected_row).removeClass('row-selected');
    $(selected_col).removeClass('col-selected');
    if (next_row.length > 0) {
        $(next_row).addClass('row-selected');
        $(next_row).find('td').eq($(selected_col).index()-1).addClass('col-selected');
    } else {
        $(getNode()).find('.add').addClass('add-selected');
    }
}

function setPositionPrevRow() {
    var selected_row = $(getNode()).find('.row-selected')
    var prev_row     = $(selected_row).prev('tr');
    var selected_col = $(selected_row).find('.col-selected');
    $(selected_row).removeClass('row-selected');
    $(selected_col).removeClass('col-selected');
    if (prev_row.length > 0) {
        $(prev_row).addClass('row-selected');
        $(prev_row).find('td').eq($(selected_col).index()-1).addClass('col-selected');
    }
}

function setPositionPrevNav() {
    var selected_nav = $('.nav-item.active');
    var prev_nav     = $(selected_nav).prev('.nav-item');
    $(selected_nav).removeClass('active');
    $('.content').removeClass('visible');
    if (prev_nav.length > 0) {
        $(prev_nav).addClass('active');
        var next_content = $(prev_nav).find('a').attr('href');
    } else {
        $('.nav-item').last().addClass('active');
        var next_content = $($('.nav-item').last()).find('a').attr('href');
    }
    $(next_content).addClass('visible');
}

function setPositionNextNav() {
    var selected_nav = $('.nav-item.active');
    var next_nav     = $(selected_nav).next('.nav-item');
    $(selected_nav).removeClass('active');
    $('.content').removeClass('visible');
    if (next_nav.length > 0) {
        $(next_nav).addClass('active');
        var next_content = $(next_nav).find('a').attr('href');
    } else {
        $('.nav-item').first().addClass('active');
        var next_content = $($('.nav-item').first()).find('a').attr('href');
    }
    $(next_content).addClass('visible');
}

function setPositionPrevCol() {
    var selected_col = $(getNode()).find('.col-selected')
    var prev_col     = $(selected_col).prev('td');
    if (prev_col.length > 0) {
        $(selected_col).removeClass('col-selected');
        $(prev_col).addClass('col-selected');
    }
}

function setPositionNextCol() {
    var selected_col = $(getNode()).find('.col-selected')
    var next_col     = $(selected_col).next('td');
    if (next_col.length > 0) {
        $(selected_col).removeClass('col-selected');
        $(next_col).addClass('col-selected');
    }
}

function keyDownPressed() {
    var modal = $('.col-selected').find('i');
    if( isRowsSelected() && !isModSelected() ) {
        if (modal.length > 0) {
            if (modal[0].className == 'fas fa-sort') {
                moveRowDown();
            } else {
                setPositionNextRow();
            }
        } else {
            setPositionNextRow();
        }
    } else if (isNavSelected()) {
        setPositionFirstRow();
    } else if (isModSelected()) {
        if (isAddSelected()) {
            if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_name')) {
                document.getElementById(getCategory() + '_boilerplate_code').focus();
            } else if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_code')) {
                document.getElementById(getCategory() + '_boilerplate_close').focus();
            } else if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_close')) {
                document.getElementById(getCategory() + '_boilerplate_save').focus();
            }
        } else if (isRowsSelected() && modal) {
            [mod_close, mod_save, mod_num] = getModalButtons(modal);
            if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_name_' + mod_num)) {
                document.getElementById(getCategory() + '_boilerplate_code_' + mod_num).focus();
            } else if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_code_' + mod_num)) {
                mod_close.focus();
            } else if (document.activeElement === mod_close) {
                mod_save.focus();
            }
        }
    }
}

function keyUpPressed() {
    if(isRowsSelected()) {
        var modal = $('.col-selected').find('i');
        if (isModSelected() && modal) {
            [mod_close, mod_save, mod_num] = getModalButtons(modal);
            if (document.activeElement === mod_save) {
                mod_close.focus();
            } else if (document.activeElement === mod_close) {
                document.getElementById(getCategory() + '_boilerplate_code_' + mod_num).focus();
            } else if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_code_' + mod_num)) {
                document.getElementById(getCategory() + '_boilerplate_name_' + mod_num).focus();
            }
        } else {
            if (modal.length > 0) {
                if (modal[0].className == 'fas fa-sort') {
                    moveRowUp();
                } else {
                    setPositionPrevRow();
                }
            } else {
                setPositionPrevRow();
            }
        }
    } else if (isAddSelected()) {
        if (isModSelected()) {
            if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_save')) {
                document.getElementById(getCategory() + '_boilerplate_close').focus();
            } else if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_close')) {
                document.getElementById(getCategory() + '_boilerplate_code').focus();
            } else if (document.activeElement === document.getElementById(getCategory() + '_boilerplate_code')) {
                document.getElementById(getCategory() + '_boilerplate_name').focus();
            }
        } else {
            setPositionLastRow();
            $(getNode()).find('.add').removeClass('add-selected');
        }
    }
}

function keyLeftPressed() {
    if (isNavSelected()) {
        setPositionPrevNav();
    } else if (isRowsSelected()) {
        var modal = $('.col-selected').find('i');
        if (isModSelected() && modal) {
            [mod_close, mod_save, mod_num] = getModalButtons(modal);
            if (document.activeElement === mod_save) {
                mod_close.focus();
            }
        } else {
            setPositionPrevCol();
        }
    } else if (isAddSelected() && isModSelected() && (document.activeElement === document.getElementById(getCategory() + '_boilerplate_save'))) {
        document.getElementById(getCategory() + '_boilerplate_close').focus();
    }
}

function keyRightPressed() {
    if (isNavSelected()) {
        setPositionNextNav();
    } else if (isRowsSelected()) {
        var modal = $('.col-selected').find('i');
        if (isModSelected() && modal) {
            [mod_close, mod_save, mod_num] = getModalButtons(modal);
            if (document.activeElement === mod_close) {
                mod_save.focus();
            }
        } else {
            setPositionNextCol();
        }
    } else if (isAddSelected() && isModSelected() && (document.activeElement === document.getElementById(getCategory() + '_boilerplate_close'))) {
        document.getElementById(getCategory() + '_boilerplate_save').focus();
    }
}

function keyEnterPressed() {
    var modal = $('.col-selected').find('i');
    var add = $(getNode()).find('.add');
    var add_modal = $(add).find('i');
    if (isAddSelected() && (add_modal.length > 0)) {
        add_modal[0].click();
        var mod_id = $(add_modal).attr('data-target');
        if (isModSelected()) {
            $(mod_id).removeClass('mod-selected');
        } else {
            $(mod_id).addClass('mod-selected');
            setTimeout(function(){
                $('#' + getCategory() + '_boilerplate_name').focus();
            }, 500);                        
        }
    } else if (isRowsSelected() && (modal.length > 0) && (modal[0].className != 'fas fa-sort')) {
        if ($(modal).attr('onclick') || (modal[0].className == 'fas fa-file-code') || (modal[0].className == 'far fa-trash-alt')) {
            modal[0].click();
        }
        if (modal[0].className != 'far fa-clipboard') {
            var mod_id = $(modal).attr('data-target');
            var mod_num = mod_id.split("_")[1];
            if (isModSelected()) {
                $(mod_id).removeClass('mod-selected');
            } else {
                $(mod_id).addClass('mod-selected');
                setTimeout(function(){
                    if (modal[0].className == 'far fa-trash-alt') {
                        $('#' + getCategory() + '_boilerplate_remove_close_' + mod_num).focus();
                    } else {
                        $('#' + getCategory() + '_boilerplate_name_' + mod_num).focus();
                    }
                }, 500);                        
            }
        }
    }
}

function removeBoilerplateEvent(i, id) {
    if (!$.active) {
        removeBoilerplate(i, id).then(resortBoilerplates).then(reloadBoilerplates).then(reloadModals);
    }
}

function removeBoilerplate(i, id) {
    var category = getCategory();
    return $.ajax({
        url: "./assets/php/boilerplate_remove.php",
        data: {"boilerplate_id":id, "boilerplate_category": category, "boilerplate_position": i},
        type: "POST",
        success: function(data) {
            $("#success-alert-removed").fadeTo(2000, 500).slideUp(500, function() {
                $("#success-alert-removed").slideUp(500);
            });
        },
        error: function(data) {
            $("#error-alert-removed").fadeTo(2000, 500).slideUp(500, function() {
                $("#error-alert-removed").slideUp(500);
            });
        }
    });
}

function resortBoilerplates(i) {
    i = i.substring(1, i.length-1);
    var i_mode = {'i': i, 'mode': 'remove'};
    var category = getCategory();
    return $.ajax({
        url: "./assets/php/boilerplate_resort.php",
        data: {"i_mode":i_mode, "boilerplate_category": category},
        type: "POST"
    });
}

function reloadBoilerplates(i_mode) {
    jsonObj = JSON.parse(i_mode)
    var i = jsonObj.i;
    var mode = jsonObj.mode;
    var category = getCategory();
    return $.ajax({
        url: "./assets/php/boilerplate_reload.php",
        data:'boilerplate_category=' + category,
        type: "POST",
        success: function(data) {
            var node = getNode();
            node.getElementsByTagName("TBODY")[0].innerHTML = '';
            $('div[id^="' + category + 'editModal_"]').remove();
            $('div[id^="' + category + 'removeModal_"]').remove();
            data = data.substring(1, data.length-1);
            rows = htmlToElements(data);
            var container = node.getElementsByTagName("TBODY")[0];
            let myArray = Array.from(rows)
            myArray.forEach(element => container.appendChild(element));
            var rows = node.getElementsByClassName("content-row");
            var num_rows = rows.length;
            if (i > num_rows) {
                var cols = rows[num_rows - 1].getElementsByTagName("TD");
                $(rows[num_rows - 1]).addClass('row-selected');
                $(node).find('.add').removeClass('add-selected');
            } else {
                var cols = rows[i - 1].getElementsByTagName("TD");
                $(rows[i - 1]).addClass('row-selected');
            }
            if (mode == 'remove') {
                $(cols[3]).addClass('col-selected');
            } else if (mode == 'sort') {
                $(cols[4]).addClass('col-selected');
            }
        }
    });
}

function reloadModals() {
    var category = getCategory();
    jQuery.ajax({
        url: "./assets/php/boilerplate_modals_reload.php",
        data:'boilerplate_category=' + category,
        type: "POST",
        success: function(data) {
            data = data.substring(1, data.length-1);
            rows = htmlToElements(data);
            var node = getNode();
            var container = node.getElementsByClassName('box')[0];
            let myArray = Array.from(rows)
            myArray.forEach(element => container.appendChild(element));
        }
    });
}

function editBoilerplate(i, id) {
    var category = getCategory();
    if (validateBoilerplateEdit(i)) {
        var boilerplate_name = encodeURIComponent($('#' + category + '_boilerplate_name_' + i).val());
        var boilerplate_code = encodeURIComponent($('#' + category + '_boilerplate_code_' + i).val());
        jQuery.ajax({
            url: "./assets/php/boilerplate_edit.php",
            data:'boilerplate_name='+boilerplate_name+'&boilerplate_code='+boilerplate_code+'&boilerplate_category='+category+'&boilerplate_id='+id,
            type: "POST",
            success: function() {
                $("#success-alert-saved").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-alert-saved").slideUp(500);
                });
                updateBoilerplate(boilerplate_name, i);
            },
            error: function() {
                $("#error-alert-saved").fadeTo(2000, 500).slideUp(500, function() {
                    $("#error-alert-saved").slideUp(500);
                });
            }
        });
    } else {
        $("#error-alert-saved").fadeTo(2000, 500).slideUp(500, function() {
            $("#error-alert-saved").slideUp(500);
        });
    }
}

function saveBoilerplate() {
    var category = getCategory();
    if (validateBoilerplate()) {
        jQuery.ajax({
            url: "./assets/php/boilerplate_save.php",
            data:'boilerplate_name='+encodeURIComponent($('#' + category + '_boilerplate_name').val())+'&boilerplate_code='+encodeURIComponent($('#' + category + '_boilerplate_code').val())+'&boilerplate_category='+ category,
            type: "POST",
            success: function() {
                $('#success-alert-saved').fadeTo(2000, 500).slideUp(500, function() {
                    $('#success-alert-saved').slideUp(500);
                });
                showNewBoilerplate();
                showNewModal('edit');
                showNewModal('remove');
            },
            error: function() {
                $("#error-alert-saved").fadeTo(2000, 500).slideUp(500, function() {
                    $("#error-alert-saved").slideUp(500);
                });
            }
        });
    } else {
        $("#error-alert-saved").fadeTo(2000, 500).slideUp(500, function() {
            $("#error-alert-saved").slideUp(500);
        });
    }
}

function validateBoilerplate() {
    return ($('#' + getCategory() + '_boilerplate_name').val() && $('#' + getCategory() + '_boilerplate_code').val() ? true : false);
}

function validateBoilerplateEdit(i) {
    return ($('#' + getCategory() + '_boilerplate_name_' + i).val() && $('#' + getCategory() + '_boilerplate_code_' + i).val() ? true : false);
}

function showNewBoilerplate() {
    var category = getCategory();
    jQuery.ajax({
        url: "./assets/php/boilerplate_show.php",
        data: 'boilerplate_category=' + category,
        method: "POST",
        success: function(data) {
            data = data.substring(1, data.length-1);
            var content = document.getElementsByClassName('content visible');
            var elem = content[0].getElementsByTagName("TBODY");
            elem[0].insertAdjacentHTML('beforeend', data);
        }
    });
}

function showNewModal(modal_type) {
    var category = getCategory();
    jQuery.ajax({
        url: "./assets/php/boilerplate_modal_show.php",
        data: 'boilerplate_category=' + category + '&modal_type=' + modal_type,
        method: "POST",
        success: function(data) {
            data = data.substring(1, data.length-1);
            modal = htmlToElement(data);
            var div = document.getElementById(category + 'addModal');
            insertAfter(div, modal);
        }
    });
}

function updateBoilerplate(boilerplate_name, i) {
    var rows = getNode().getElementsByClassName("content-row");
    for(var i_row = 0; i_row < rows.length; i_row++) {
        if (rows[i_row].getElementsByTagName("TH")[0].innerHTML == i) {
            rows[i_row].getElementsByTagName("TD")[0].innerHTML = boilerplate_name;
        }
    }
}

function copyToClipboard(i) {
    const el = document.createElement('textarea');
    el.value = document.getElementById(getCategory() + '_boilerplate_code_' + i).value;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    $("#success-alert-copied").fadeTo(2000, 500).slideUp(500, function() {
        $("#success-alert-copied").slideUp(500);
    });
  }

function moveRowDown() {
    var row = getNode().getElementsByClassName("row-selected")[0];
    var next = row.nextElementSibling;
    if (next && !$.active) {
        swapSorting(row.firstElementChild.innerHTML, next.firstElementChild.innerHTML).then(reloadBoilerplates).then(reloadModals);
    }
}

function moveRowUp() {
    var row = getNode().getElementsByClassName("row-selected")[0];
    var prev = row.previousElementSibling;
    if (prev && !$.active) {
        swapSorting(row.firstElementChild.innerHTML, prev.firstElementChild.innerHTML).then(reloadBoilerplates).then(reloadModals);
    }
}

function swapSorting(row_num, next_row_num) {
    var i_mode = {'i': next_row_num, 'mode': 'sort'};
    var category = getCategory();
    return $.ajax({
        url: "./assets/php/boilerplate_swap.php",
        data: {"i_mode":i_mode, "boilerplate_category": category , "boilerplate_a": row_num, "boilerplate_b": next_row_num},
        method: "POST"
    });
}

function htmlToElement(html) {
    var template = document.createElement('template');
    template.innerHTML = html.trim();
    return template.content.firstChild;
}

function htmlToElements(html) {
    var template = document.createElement('template');
    template.innerHTML = html.trim();
    return template.content.childNodes;
}

function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function getModalButtons(modal) {
    var mod_num = $(modal).attr('data-target').split("_")[1];
    if (modal[0].className == 'far fa-trash-alt') {
        var mod_close = document.getElementById(getCategory() + '_boilerplate_remove_close_' + mod_num);
        var mod_save = document.getElementById(getCategory() + '_boilerplate_remove_save_' + mod_num);
    } else {
        var mod_close = document.getElementById(getCategory() + '_boilerplate_edit_close_' + mod_num);
        var mod_save = document.getElementById(getCategory() + '_boilerplate_edit_save_' + mod_num);
    }
    return [mod_close, mod_save, mod_num];
}