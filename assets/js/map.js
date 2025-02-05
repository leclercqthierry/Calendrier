let locations = document.querySelectorAll('.location');
let latArr = [];
let longArr = [];

locations.forEach((p) => {
    let splitWord = p.textContent.split(',');
    let latitude = (Number)(splitWord[0].split('latitude:')[1].trim());
    let longitude = (Number)(splitWord[1].split('longitude:')[1].trim());
    latArr.push(latitude);
    longArr.push(longitude);
});