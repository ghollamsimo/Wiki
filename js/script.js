document.addEventListener('DOMContentLoaded', function() {
    var getnameInput = document.getElementById('getname');
    var showDataElement = document.getElementById('showdata');

    getnameInput.addEventListener('input', function() {
        var getname = getnameInput.value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/wiki/public/home', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    showDataElement.innerHTML = xhr.responseText;
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };

        xhr.send('name=' + getname);
    });
});