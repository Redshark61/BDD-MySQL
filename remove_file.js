let btn_remove = document.querySelectorAll('[name = "remove"]');

for (let index = 0; index < btn_remove.length; index++) {
    btn_remove[index].addEventListener("click", () => {
        window.location.href = window.location.href + "&remove=" + btn_remove[index].value;
    });
}
