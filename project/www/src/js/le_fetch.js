function fetch_txt(url) {
    return fetch(url)
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

function fetch_html(url) {
    return fetch(url)
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

function fetch_php(url) {
    return fetch(url)
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

function data(data) {
    let text = "";
    for (var key in data) {
      text += key + "=" + data[key] + "&";
    }
    return text.trim("&");
}

function fetch_post(url, dataArray) {
    let dataObject = this.data(dataArray);
    return fetch(url, {
             method: "post",
             headers: {
                   "Content-Type": "application/x-www-form-urlencoded",
             },
             body: dataObject,
        })
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

function fetch_gest(url, dataArray) {
    let dataObject = this.data(dataArray);
    return fetch(url, {
             method: "gest",
             headers: {
                   "Content-Type": "application/x-www-form-urlencoded",
             },
             body: dataObject,
        })
        .then((response) => response.text())
        .catch((error) => console.error("Error:", error));
}

