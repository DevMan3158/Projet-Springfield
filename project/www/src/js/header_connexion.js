function popupWindow(url, windowName, win, w, h) {
    const y = win.top.outerHeight / 2 + win.top.screenY - ( h / 2);
    const x = win.top.outerWidth / 2 + win.top.screenX - ( w / 2);
    return win.open(url, windowName, `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`);
}

function header_connexion(e) {
    let startLink = "./src/";
    var hostname_origin = document.location.href;
    if (hostname_origin.search("sgd-admin") != -1) {
        startLink = "./../src/";
    }
    popupWindow(startLink+"pages/connexion.php", "connexion", window, 320, 360);
}

if(document.getElementById('btt_conn')) {
    document.getElementById('btt_conn').addEventListener("click", header_connexion);
}