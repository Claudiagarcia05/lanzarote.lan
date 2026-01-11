document.addEventListener("DOMContentLoaded", function () {

    const select = document.getElementById("idcalendario_curso");
    const loader = document.getElementById("loader");

    console.log("Select:", select);
    console.log("Loader:", loader);

    if (!select) return;

    select.addEventListener("change", function () {
        loader.style.display = "block";

        fetch("?curso=" + this.value)
            .then(r => r.text())
            .then(html => {
                document.getElementById("place_calendario").innerHTML = html;
                loader.style.display = "none";
            })
            .catch(() => loader.style.display = "none");
    });
});