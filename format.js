const buttons = document.querySelectorAll(".format");
var list_shortcut = [
    ["img", ['</p><IMG "', '" alt=""><p>']],
    ["h1", ["</p><h1>", "</h1><p>"]],
    [
        "question",
        [
            '</p><div class="question"><div class="question-img"><img src="sources/ressources/question-mark.png"></div><p>',
            "</p></div><p>",
        ],
    ],
    ["span_code", ['<span class="code">', "</span>"]],
    ["video", ['<VIDEO "', '" type="video/mp4"/></video>']],
    ["subh1", ['</p><h2 class="sub-h1">', "</h2><p>"]],
    ["bold", ["<b>", "</b>"]],
];

buttons.forEach((button) => {
    button.addEventListener("click", () => {
        var textarea = document.querySelector("#contenu");
        s = window.getSelection();
        oRange = s.getRangeAt(0); //get the text range
        var beginning_text = textarea.value.substr(0, textarea.selectionStart);
        var selected_text = window.getSelection().toString();
        var end_text = textarea.value.substr(textarea.selectionEnd);

        for (var i = 0; i != list_shortcut.length; i++) {
            var tag = list_shortcut[i][0];
            var start = list_shortcut[i][1][0];
            var end = list_shortcut[i][1][1];
            if (tag == button.id) {
                selected_text = start + selected_text + end;
            }
        }
        result = beginning_text + selected_text + end_text;
        textarea.value = result;
    });
});
