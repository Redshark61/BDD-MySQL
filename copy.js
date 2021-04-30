const button_transform = document.querySelector(".transform");
const buttton_copy = document.querySelector(".copy");

button_transform.addEventListener("click", () => {
    var code = document.querySelector("#editeur").value;
    code = code.replace(/\u0026/g, "&amp;");
    code = code.replace(/</g, "&lt;");
    console.log(typeof code);
    const regex_html = new RegExp("html");
    const regex_css = new RegExp("css");
    const regex_js = new RegExp("js");
    const regex_php = new RegExp("php");
    if (regex_html.test(code)) {
        code = code.replace(/html/, "");
        code = '<pre>\n<code class="language-html">\n' + code + "\n</code>\n</pre>";
    } else if (regex_js.test(code)) {
        code = code.replace(/js/, "");
        code = '<pre>\n<code class="language-javascript">\n' + code + "\n</code>\n</pre>";
    } else if (regex_php.test(code)) {
        code = code.replace(/php/, "");
        code = '<pre>\n<code class="language-php">\n' + code + "\n</code>\n</pre>";
    } else if (regex_css.test(code)) {
        code = code.replace(/css/, "");
        code = '<pre>\n<code class="language-css">\n' + code + "\n</code>\n</pre>";
    }
    document.getElementById("editeur").value = code;
});

buttton_copy.addEventListener("click", () => {
    var code = document.querySelector("#editeur");
    code.select();
    document.execCommand("copy");
});
