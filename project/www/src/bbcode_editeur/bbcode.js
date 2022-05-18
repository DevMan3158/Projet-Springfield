/**
 * Le tableau de valeur du bbcode et sa conversion
 * @returns tableau du bbcode et sa conversion.
 */
function tab_values() {
    return [
        ['<', '>', '[b]', '[/b]', '[title]', '[/title]', "\n", "\n", "\n", '  '],
        ['&lt;', '&gt;', '<strong>', '</strong>', '<span class=\"bb_title\">', '</span>', '<br />', '<br>', '<br >', '&nbsp;&nbsp;'],
    ]; 
}

/**
 * Recuperer le noeud du texte avec bbcode
 * 
 * @param {*} itemTxt le noeud de depart (pour aller au noeud parent)
 * @returns le noeud du texte avec bbcode
 */
function recupe_editor_bb(itemTxt) {
    let edit = undefined;
    itemTxt.parentNode.querySelectorAll('.editor_bbcode').forEach(function(item) {
        edit = item;
    });
    return edit;
}

/**
 * Recuperer le noeud du texte avec html
 * 
 * @param {*} itemTxt le noeud depart (pour aller au noeud parent)
 * @returns le noeud du texte avec html
 */
function recupe_editor_html(itemTxt) {
    let edit = undefined;
    itemTxt.parentNode.querySelectorAll('.editor_html_bbcode').forEach(function(item) {
        edit = item;
    });
    return edit;
}

/**
 * Recuperer le noeud qui contient l'affichage (bbcode ou html)
 * 
 * @param {*} itemTxt le noeud depart (pour aller au noeud parent)
 * @returns le noeud qui contient l'affichage (bbcode ou html)
 */
function recupe_editor_type(itemTxt) {
    let edit = undefined;
    itemTxt.parentNode.querySelectorAll('.bbcode_type').forEach(function(item) {
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
        editHtml.value = conversion_bbcode(editTxt.innerHTML.replaceAll('&nbsp;', ' ').replaceAll('<div>', '').replaceAll('</div>', ''), edit_type);
    }
}

function modifTxtHtmlValueStEd(range, allTab) {
    let endOffset = range.endOffset;
    let startOffset = range.startOffset;
    let endText = range.endContainer.nodeValue;
    let startText = range.startContainer.nodeValue;
    endText = modifTxtHtmlValue(endText, allTab[1], endOffset);
    startText = modifTxtHtmlValue(startText, allTab[0], startOffset);
}

function modifTxtHtmlValue(range, allTab) {
    let value = remplaceTxt(range.startContainer.nodeValue, allTab, range.startOffset, range.endOffset);
    console.log("value : "+value);
}

function remplaceSelectHtml(edithtml, type) {
    let sel;
    if (document.getSelection) {    // all browsers, except IE before version 9
        sel = document.getSelection();
    } 
    else {
        sel = document.selection;   // Internet Explorer before version 9
    }
    let allTab = addBalise(0, type);
    let range = sel.getRangeAt(0);
    let endContainer = range.endContainer;
    let newNode = undefined;
    if(allTab[0] == "[b]") {
        newNode = document.createElement("STRONG");
    } else if(allTab[0] == "[title]") {
        newNode = document.createElement("SPAN");
        newNode.classList.add("bb_title");
    }
    if(newNode != undefined) {
        try {
            range.surroundContents(newNode);
        } catch(e) { alert("Action impossible.") }
    }
    range = document.createRange();
    sel.removeAllRanges();
    range.selectNodeContents(endContainer);
    range.collapse(false);
    sel.addRange(range);
    edithtml.focus();
}

function remplaceTxt(text, allTab, posStart, posEnd) {
    let add_start = allTab[0];
    let add_end = allTab[1];
    pretext = "";
    selectedtext = "";
    posttext = "";
    if(posStart == posEnd) {
        pretext = text.substring(0,posStart);
        posttext = text.substring(posEnd,text.length);
    } else {
        pretext = text.substring(0,posStart);
        selectedtext = text.substring(posStart,posEnd);
        posttext = text.substring(posEnd,text.length);
    }
    return pretext+add_start+selectedtext+add_end+posttext;
}

function remplaceSelectText(edit, type) {
    return remplaceTxt(edit.value, addBalise(0, type), edit.selectionStart, edit.selectionEnd);
}

function addBalise(intType, type) {
    let allTab = tab_values();
    let tab = allTab[intType];
    if(type == "b") {
        add_start = tab[2];
        add_end = tab[3];
    } else if(type == "t") {
        add_start = tab[4];
        add_end = tab[5];
    }
    return [add_start, add_end];
}

function bbcode_add_txt(e, type) {
    let edit_type = recupe_editor_type(e.target);
    let edit = recupe_editor_html(e.target);
    if(edit_type.value == "txt") {
        edit = recupe_editor_bb(e.target);
    }
    if(type !== undefined) {
        if(edit_type.value == "txt") {
            edit.value = remplaceSelectText(edit, type);
        } else {
            remplaceSelectHtml(edit, type);
        }
    }
    display_text(edit);
}

function replace_bb_html(textBB) {
    if(textBB != undefined) {
        let tab = tab_values();
        for(i = 0; i < tab[0].length; i++) {
            textBB = textBB.replaceAll(tab[0][i], tab[1][i]);
        }
        return textBB;
    }
    return "";
}

function editor_bbcode(itemTxt) {
    let edit = recupe_editor_bb(itemTxt);
    var input = document.createElement("div");
    input.classList.add("editor_html_bbcode");
    input.style.width = edit.style.offsetWidth;
    input.style.height = edit.style.offsetHeight;
    input.contentEditable = true;
    input.innerHTML = replace_bb_html(edit.value);
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

/* les boutons du bbcode */
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

