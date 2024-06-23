function filtre(x) {
    let my_select = document.getElementsByName(x);
    my_select[0].addEventListener("click", () => {
        let vehicles = document.getElementsByClassName("vehicle");
        if (my_select[0].value == "toute") {
            for (let i = 0; i < vehicles.length; i++) {
                if (vehicles[i].classList.contains("invisible")) {
                    vehicles[i].classList.remove("invisible");
                }
            }
        } else {
            for (let i = 0; i < vehicles.length; i++) {
                if (vehicles[i].dataset.idmarque != my_select[0].value && !vehicles[i].classList.contains("invisible")) {
                    vehicles[i].classList.add("invisible");
                }
                else if (vehicles[i].dataset.idmarque == my_select[0].value && vehicles[i].classList.contains("invisible")) {
                    vehicles[i].classList.remove("invisible");
                }
            }
        }
    }
)}
 
window.onload = function() {
    filtre("brand");
    };