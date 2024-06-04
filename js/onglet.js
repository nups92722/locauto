function collect_tab(div_onglet) {
    let tabs = [];
    let div_menu = div_onglet.getElementsByClassName("menu_tab");

    for (let i = 0; i < div_menu[0].children.length; i++) {
        tabs.push(div_menu[0].children[i]);
    }
    return (tabs);
}

function collect_content(div_onglet) {
    let contents = [];
    
    for (let i = 0; i < div_onglet.children.length; i++) {
        if (div_onglet.children[i].classList.contains("content_tab")) {
            contents.push(div_onglet.children[i]);
        }
    }
    return (contents);
}

function create_onglet() {
    let div_onglets = document.getElementsByClassName("tab_block");

    for (let i = 0; i < div_onglets.length; i++) {
        let div_onglet = div_onglets[i];
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
}