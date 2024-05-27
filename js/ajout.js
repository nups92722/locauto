function checked_box(id, id_checkbox) {
    let div_onglet = document.getElementById(id);
    let tabs = collect_tab(div_onglet);
    let checkbox = document.getElementById(id_checkbox);

    tabs[0].addEventListener("click", () => {
        checkbox.checked = false;
    });
    tabs[1].addEventListener("click", () => {
        checkbox.checked = true;
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