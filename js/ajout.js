function gestion_input_requirement(content, value) {
    let input = content.querySelectorAll('input');

    if (input != null) {
        for (let i = 0; i < input.length; i++) {
            if (!input[i].classList.contains("check_selected_tab")){
                input[i].required = value;
            }
            if (value == false) {
                input[i].disabled = true;
            } else {
                input[i].disabled = false;
            }
        }
    }
}

function gestion_inner_checked_box(div) {
    let div_onglets = div.getElementsByClassName("tab_block");
    console.log(div_onglets);

    for (let i = 0; i < div_onglets.length; i++) {
        let div_onglet = div_onglets[i];
        let checkbox = div_onglet.getElementsByClassName("check_selected_tab")[0];
        let contents = collect_content(div_onglet);

        console.log(checkbox.checked, div_onglet);

        if(checkbox.checked == false) {
            gestion_input_requirement(contents[0], true);
            gestion_input_requirement(contents[1], false);
            console.log("click", checkbox.checked);
        } else {
            gestion_input_requirement(contents[0], false);
            gestion_input_requirement(contents[1], true);
            console.log("click", checkbox.checked);
        };
    }
}

function gestion_checked_box() {
    let div_onglets = document.getElementsByClassName("tab_block");
    let all_checkbox = document.getElementsByClassName("check_selected_tab");

    for (let i = 0; i < div_onglets.length; i++) {
        let div_onglet = div_onglets[i];
        let checkbox =  all_checkbox[i];
        let tabs = collect_tab(div_onglet);
        let contents = collect_content(div_onglet);

        tabs[0].addEventListener("click", () => {
            checkbox.checked = false;
            gestion_input_requirement(contents[0], true);
            gestion_input_requirement(contents[1], false);
        });
        tabs[1].addEventListener("click", () => {
            checkbox.checked = true;
            gestion_input_requirement(contents[0], false);
            gestion_input_requirement(contents[1], true);
            gestion_inner_checked_box(div_onglet);
        });
    }
}

window.onload = function() {
    gestion_checked_box();
    create_onglet();
};