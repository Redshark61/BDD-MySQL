const button_transform = document.querySelector("#transform");
const buttton_copy = document.querySelector(".copy");

button_transform.addEventListener("click", () => {
    var textarea = document.querySelector("#contenu");
    s = window.getSelection();
    oRange = s.getRangeAt(0); //get the text range
    var beginning_text = textarea.value.substr(0, textarea.selectionStart);
    var selected_text = window.getSelection().toString();
    var end_text = textarea.value.substr(textarea.selectionEnd);
    selected_text = selected_text.replace(/\u0026/g, "&amp;");
    selected_text = selected_text.replace(/</g, "&lt;");
    // console.log(typeof selected_text);
    const regex_html = new RegExp("#html");
    const regex_css = new RegExp("#css");
    const regex_js = new RegExp("#js");
    const regex_php = new RegExp("#php");
    if (regex_html.test(selected_text)) {
        selected_text = selected_text.replace(/#html/, "");
        selected_text =
            '</p><pre>\n<code class="language-html">\n' + selected_text + "\n</code>\n</pre><p>";
    } else if (regex_js.test(selected_text)) {
        selected_text = selected_text.replace(/#js/, "");
        selected_text =
            '</p><pre>\n<code class="language-javascript">\n' +
            selected_text +
            "\n</code>\n</pre><p>";
    } else if (regex_php.test(selected_text)) {
        selected_text = selected_text.replace(/#php/, "");
        selected_text =
            '</p><pre>\n<code class="language-php">\n' + selected_text + "\n</code>\n</pre><p>";
    } else if (regex_css.test(selected_text)) {
        selected_text = selected_text.replace(/#css/, "");
        selected_text =
            '</p><pre>\n<code class="language-css">\n' + selected_text + "\n</code>\n</pre><p>";
    }
    result = beginning_text + selected_text + end_text;
    textarea.value = result;
});
