let ratings = document.querySelectorAll("#check_score");
let uncheck_rating = document.getElementById("uncheck_rating");
let check_rating = document.getElementById("check_rating");

uncheck_rating.addEventListener("click", function unCheckBox() {
    ratings.forEach(function(rating) {
        rating.checked = false;
    });
});

check_rating.addEventListener("click", function CheckBox() {
    ratings.forEach(function(rating) {
        rating.checked = true;
    });
});

let provinces = document.querySelectorAll("#check_province");
let uncheck_province = document.getElementById("uncheck_province");
let check_province = document.getElementById("check_province");

uncheck_province.addEventListener("click", function unCheckBox() {
    provinces.forEach(function(province) {
        province.checked = false;
    });
});

check_province.addEventListener("click", function CheckBox() {
    provinces.forEach(function(province) {
        province.checked = true;
    });
});

