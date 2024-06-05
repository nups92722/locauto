function collect_input_select(content) {
    let inputs = content.querySelectorAll('input');
    let selects = content.querySelectorAll('select');
    let all = [...inputs, ...selects];
    
    return (all);
}

function gestion_input_requirement(div_onglet) {
    let contents = collect_content(div_onglet);
    let input = null;
    let div_onglets = null;

    for (let i = 0; i < contents.length; i++) {
        if (contents[i].classList.contains("invisible")) {
            input = collect_input_select(contents[i]);
            for (let j = 0; j < input.length; j++) {
                input[j].disabled = true;
                input[j].required = false;
            }
        } else {
            input = collect_input_select(contents[i]);
            for (let j = 0; j < input.length; j++) {
                input[j].required = true;
                input[j].disabled = false;
            }
            div_onglets = div_onglet.getElementsByClassName("tab_block");
            for (let j = 0; j < div_onglets.length; j++) {
                gestion_input_requirement(div_onglets[j])
            }
        }
    }
}



function event_input_requirement() {
    let div_onglets = document.getElementsByClassName("tab_block");

    for (let i = 0; i < div_onglets.length; i++) {
        let div_onglet = div_onglets[i];
        let tabs = collect_tab(div_onglet);

        for (let i = 0; i < tabs.length; i++) {
            tabs[i].addEventListener("click", () => {
                gestion_input_requirement(div_onglet);
            });
        };
    }
}

window.onload = function() {
    create_onglet();
    event_input_requirement();
};