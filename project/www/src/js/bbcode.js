function tab_values() {
    return [
        ['[b]', '[/b]', '[title]', '[/title]', '\n', ' '],
        ['<strong>', '</strong>', '<span class=\"bb_title\">', '</span>', '<br />', '&nbsp;'],
    ];
}

function recupe_editor_bb(itemTxt) {
    let edit_text = itemTxt.parentNode.querySelectorAll('.editor_bbcode');
    edit_text.forEach(function(item) {
        edit = item;
    });
    return edit;
}

function recupe_editor_html(itemTxt) {
    let edit_text = itemTxt.parentNode.querySelectorAll('.editor_html_bbcode');
    edit_text.forEach(function(item) {
        edit = item;
    });
    return edit;
}

function recupe_editor_type(itemTxt) {
    let edit_text = itemTxt.parentNode.querySelectorAll('.bbcode_type');
    edit_text.forEach(function(item) {
        edit = item;
    });
    return edit;
}

function conversion_bbcode(chaine, edit_type) {
    let allTab = tab_values();
    let tabFrom = allTab[1];
    let tabTo = allTab[0];
    if(edit_type.value == "txt") {
        tabFrom = allTab[0];
        tabTo = allTab[1];
    }
    for(let i=0; i < tabFrom.length; i++) {
        chaine = chaine.replaceAll(tabFrom[i], tabTo[i]);
    }
    return chaine;
}

function display_text(editTxt) {
    let edit_type = recupe_editor_type(editTxt);
    let editHtml = recupe_editor_bb(editTxt);
    if(edit_type.value == "txt") {
        editHtml = recupe_editor_html(editTxt);
        editHtml.innerHTML = conversion_bbcode(editTxt.value, edit_type);
    } else {
        editHtml.value = conversion_bbcode(editTxt.innerHTML, edit_type);
    }
}

function GetSelectedText() {
    let value = [];
    if (document.getSelection) {    // all browsers, except IE before version 9
        var sel = document.getSelection();
        value = [sel.anchorOffset, sel.focusOffset];
    } 
    else {
        if (document.selection) {   // Internet Explorer before version 9
            value = [document.selection.anchorOffset, document.selection.focusOffset];
        }
    }
    return value;
}

function bbcode_add_txt(e, type) {
    let edit_type = recupe_editor_type(e.target);
    let edit = recupe_editor_html(e.target);
    let add_start = "";
    let add_end = "";
    let allTab = tab_values();
    let tab = allTab[1];
    if(edit_type.value == "txt") {
        tab = allTab[0];
        edit = recupe_editor_bb(e.target);
    }
    if(type !== undefined) {
        if(type == "b") {
            add_start = tab[0];
            add_end = tab[1];
        } else if(type == "t") {
            add_start = tab[2];
            add_end = tab[3];
        }
        let text = "";
        let selectionStart = 0;
        let selectionEnd = 0;
        if(edit_type.value == "txt") {
            text = edit.value;
            selectionStart = edit.selectionStart;
            selectionEnd = edit.selectionEnd;
        } else {
            text = edit.innerHTML;
            let valuesSelect = GetSelectedText();
            selectionStart = valuesSelect[0];
            selectionEnd = valuesSelect[1];
        }
        console.log("start : "+selectionStart);
        console.log("stop : "+selectionEnd);
        console.log(text);
        console.log(text.length);
        pretext = "";
        selectedtext = "";
        posttext = "";
        if(selectionStart == selectionEnd) {
            pretext = text.substring(0,selectionStart);
            posttext = text.substring(selectionEnd,text.length);
        } else {
            pretext = text.substring(0,selectionStart);
            selectedtext = text.substring(selectionStart,selectionEnd);
            posttext = text.substring(selectionEnd,text.length);
        }
        let valueTxt = pretext+add_start+selectedtext+add_end+posttext;
        if(edit_type.value == "txt") {
            edit.value = valueTxt;
        } else {
            edit.innerHTML = valueTxt;
        }
    }
    display_text(edit);
}

function conversion_bbcode_to_txt(chaine) {
    chaine = chaine.replaceAll("<strong>", "[b]");
    chaine = chaine.replaceAll("</strong>", "[/b]");
    chaine = chaine.replaceAll("<span class=\"bb_title\">", "[title]");
    chaine = chaine.replaceAll("</span>", "[/title]");
    chaine = chaine.replaceAll("<br />", "\n");
    return chaine;
}

function display_text_to_txt(editTxt) {
    let editHtml = recupe_editor_html(editTxt);
    editTxt.value = conversion_bbcode_to_txt(editHtml.innerHTML);
}

function editor_bbcode(itemTxt) {
    let edit = recupe_editor_bb(itemTxt);
    var input = document.createElement("div");
    input.classList.add("editor_html_bbcode");
    input.style.width = edit.style.offsetWidth;
    input.style.height = edit.style.offsetHeight;
    input.contentEditable = true;
    edit.parentNode.appendChild(input);
    var inputType = document.createElement("input");
    inputType.setAttribute("type", "hidden");
    inputType.classList.add("editor_type_bbcode");
    inputType.value = "html";
    edit.parentNode.appendChild(inputType);
    edit.readOnly = true;
    edit.style.display = "none";
    return recupe_editor_html(edit);
}

function bbcode_bold(e) {
    bbcode_add_txt(e, "b");
}

function bbcode_title(e) {
    bbcode_add_txt(e, "t");
}

function bbcode_change(e) {
    bbcode_add_txt(e, undefined);
}

function bbcode_key(event) {
    let edit_type = recupe_editor_type(event.target);
    if(edit_type.value == "txt") {
        const nomTouche = event.key;
        if (nomTouche === 'Control') {
        return;
        }
        bbcode_change(event);
    }
}

function bbcode_key_html(event) {
    let edit_type = recupe_editor_type(event.target);
    if(edit_type.value != "txt") {
        const nomTouche = event.key;
        if (nomTouche === 'Control') {
        return;
        }
        bbcode_change(event);
    }
}

function resize_bb_text(e) {
    let edit_text = e.target;
    let edit_html = recupe_editor_html(edit_text);
    edit_html.style.width = edit_text.style.offsetWidth;
    edit_html.style.height = edit_text.style.offsetHeight;
}

function resize_bb_html(e) {
    let edit_html = e.target;
    let edit_text = recupe_editor_bb(edit_html);
    edit_text.style.width = edit_html.style.offsetWidth;
    edit_text.style.height = edit_html.style.offsetHeight;
}

let bbcode_edit = document.querySelectorAll('.editor_bbcode');
bbcode_edit.forEach(function(item) {
    itemHtml = editor_bbcode(item);
    item.addEventListener('change', bbcode_change);
    itemHtml.addEventListener('change', bbcode_change);
    item.addEventListener('keyup', bbcode_key);
    itemHtml.addEventListener('keyup', bbcode_key_html);
    item.addEventListener('resize', resize_bb_text);
    itemHtml.addEventListener('resize', resize_bb_html);
});

function bbcode_type(e) {
    let edit_html = recupe_editor_html(e.target);
    let edit_text = recupe_editor_bb(e.target);
    let edit_type = recupe_editor_type(e.target);
    if(edit_type.value == "txt") {
        edit_html.readOnly = false;
        edit_text.readOnly = true;
        edit_html.style.display = "block";
        edit_text.style.display = "none";
        edit_type.value = "html";
    } else {
        edit_html.readOnly = true;
        edit_text.readOnly = false;
        edit_html.style.display = "none";
        edit_text.style.display = "block";
        edit_type.value = "txt";
    }
}

let bbcode_bold_bt = document.querySelectorAll('.bbcode_bold');
bbcode_bold_bt.forEach(function(item) {
    item.addEventListener('click', bbcode_bold);
});

let bbcode_title_bt = document.querySelectorAll('.bbcode_title');
bbcode_title_bt.forEach(function(item) {
    item.addEventListener('click', bbcode_title);
});

let bbcode_type_dsp = document.querySelectorAll('.bbcode_type');
bbcode_type_dsp.forEach(function(item) {
    item.addEventListener('click', bbcode_type);
});

