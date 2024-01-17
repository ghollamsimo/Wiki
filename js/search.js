document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("show-data").style.display = "none";

    document.getElementById("search-form").addEventListener("keyup", function() {
        var getname = document.getElementById("getname").value;

        if (getname !== "") {
            let wikis = "";
            document.getElementById("main-data").style.display = "none";
            document.getElementById("show-data").style.display = "block";

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "http://localhost/wiki/public/home/search", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var responseJson = JSON.parse(xhr.responseText);

                    if (responseJson.length > 0) {
                        responseJson.forEach(function(el) {
                            wikis += `
                                <div class="card">
                                    <div class="card__body">
                                        <span class="tag tag-blue">${el.namecategory}</span>
                                        <span>${el.idtag}</span>
                                        <h4>${el.Title}</h4>
                                        <p>${el.Descreption}
                                            <a class="font-bold" href="/wiki/public/home/Singlewiki/${el.idwiki}">Read More</a>
                                        </p>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        wikis += `<p>No Wikis Found!</p>`;
                    }

                    document.getElementById("show-data").innerHTML = wikis;
                } else if (xhr.readyState === 4) {
                    console.error('Error:', xhr.status);
                }
            };

            xhr.send("searchKey=" + getname);
        } else {
            document.getElementById("main-data").style.display = "block";
            document.getElementById("show-data").style.display = "none";
        }
    });
});
