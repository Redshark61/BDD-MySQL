const buttons = document.querySelectorAll(".format");
var list_shortcut = [
    ["img", ['<IMG "', '" alt="">']],
    ["h1", ["</p><h1>", "</h1><p>"]],
    [
        "question",
        [
            '</p><div class="question"><div class="question-img"><img src="ressources/question-mark.png"></div><p>',
            "</p></div><p>",
        ],
    ],
];

buttons.forEach((button) => {
    button.addEventListener("click", () => {
        var textarea = document.querySelector("#contenu");
        //var text_p = document.querySelector("#contenu");
        s = window.getSelection();
        oRange = s.getRangeAt(0); //get the text range
        var beginning_text = textarea.value.substr(0, textarea.selectionStart);
        console.log("Début = ", beginning_text);
        var selected_text = window.getSelection().toString();
        console.log("Sélectionné = ", selected_text);
        var end_text = textarea.value.substr(textarea.selectionEnd);
        console.log("endOffset = ", oRange);
        console.log("Fin = ", end_text);

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
        textarea.value = result;
    });
});
