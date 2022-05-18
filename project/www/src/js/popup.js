function popupWindow(url, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

function popupHTMLWindow(html, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    var myWindow = win.open('', windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, titlebar=no, location=no, width=${w}, height=${h}, top=${y}, left=${x}`);
    myWindow.document.write(html);
}

function modal() {
    document.querySelectorAll(".button").forEach(function (btn) {
      btn.onclick = function (event) {
        event.preventDefault();
        let modal = btn.getAttribute("data-modal");
        if(modal != undefined) {
            document.getElementById(modal).style.display = "block";
        }
      };
    });
    document.querySelectorAll(".close").forEach(function (btn) {
      btn.onclick = function (event) {
        event.preventDefault();
        let modal = btn.closest(".modal");
        modal.style.display = "none";
      };
    });
    window.onclick = function (event) {
        event.preventDefault();
      if (event.target.className === "modal") {
        event.target.style.display = "none";
      }
    };
}

function clickModal(nameModal) {
    var btn = document.createElement("BUTTON");
    btn.classList.add("button");
    btn.setAttribute("data-modal", nameModal);
    console.log(btn);
    modal();
    btn.click();
}