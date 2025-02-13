function Slider(obj1, obj2) {
    if (obj1.style.display == "none") {
        obj1.style.display = "flex";
        add.innerHTML = "-";
        obj2.style.display = "none";
    } else {
        obj1.style.display = "none";
        add.innerHTML = "+";
        obj2.style.display = "flex";
    }
}

function Filter(target, filter) {
    window.location.href = target + ".php?filter=" + filter;
}

function autoFill(content) {
    to.value = content;
    Slider(editor, chat);
}

//style_source.href = "../CSS/style_2.css";