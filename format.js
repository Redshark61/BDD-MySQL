const buttons = document.querySelectorAll(".format");
var list_shortcut = [
    ["img", ['<img src="', '">']],
    ["h1", ["<h1>", "</h1>"]],
];

buttons.forEach((button) => {
    button.addEventListener("click", () => {
        var text_value = document.querySelector("p");
        var text_p = document.querySelector("p");
        s = window.getSelection();
        oRange = s.getRangeAt(0); //get the text range
        var beginning_text = text_value.innerHTML.substr(0, oRange.startOffset);
        var selected_text = window.getSelection().toString();
        var end_text = text_value.innerHTML.substr(oRange.endOffset);

        for (var i = 0; i != list_shortcut.length; i++) {
            var tag = list_shortcut[i][0];
            var start = list_shortcut[i][1][0];
            var end = list_shortcut[i][1][1];
            if (tag == button.id) {
                selected_text = start + selected_text + end;
            }
        }
        result = beginning_text + selected_text + end_text;
        console.log(result);
        text_p.innerHTML = result;
    });
});
