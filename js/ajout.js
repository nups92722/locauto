function gestion_requirement(content, value) {
    let input = content.querySelector('input');

    if (input != null) {
        for (let i = 0; i < input.length; i++) {
            input[i].required = value;
        }
    }
}

function checked_box(id, id_checkbox) {
    let div_onglet = document.getElementById(id);
    let tabs = collect_tab(div_onglet);
    let contents = collect_content(div_onglet);
    let checkbox = document.getElementById(id_checkbox);
    
    tabs[0].addEventListener("click", () => {
        checkbox.checked = false;
        gestion_requirement(contents[0], true);
        gestion_requirement(contents[1], false);
    });
    tabs[1].addEventListener("click", () => {
        checkbox.checked = true;
        gestion_requirement(contents[0], false);
        gestion_requirement(contents[1], true);
    });
}

window.onload = function() {
    create_onglet("modele");
    checked_box("modele", "new_modele");
    create_onglet("categorie");
    checked_box("categorie", "new_categorie");
    create_onglet("motorisation");
    checked_box("motorisation", "new_motorisation");
};