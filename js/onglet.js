function collect_tab(div_onglet) {
    let tabs = [];
    let div_menu = div_onglet.getElementsByClassName("tab_menu");

    for (let i = 0; i < div_menu[0].children.length; i++) {
        tabs.push(div_menu[0].children[i]);
    }
    return (tabs);
}

function collect_content(div_onglet) {
    let contents = [];
    
    for (let i = 0; i < div_onglet.children.length; i++) {
        if (div_onglet.children[i].classList.contains("content")) {
            contents.push(div_onglet.children[i]);
        }
    }
    return (contents);
}

function create_onglet(id) {
    let div_onglet = document.getElementById(id);
    let tabs = collect_tab(div_onglet);
    let contents = collect_content(div_onglet);

    for (let i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", () => {
            for (let j = 0; j < tabs.length; j++){
                if (tabs[j].classList.contains("selected") && j != i) {
                    tabs[j].classList.remove("selected");
                    contents[j].classList.add("invisible");
                } else if (!tabs[j].classList.contains("selected") && j == i) {
                    tabs[j].classList.add("selected");
                    contents[j].classList.remove("invisible");
            };
        }
    });
    };
}