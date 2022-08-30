
let dropdown = document.querySelector('#country-dropdown');
fetch('../countries/countries.json').then(res => {
    return res.json();
}).then(data => {
    let option = '';
    data.forEach(data => {
        //adding country flag and cuntry name for each data
        option += `<option>${data.name}</option>`;
        //adding options to dropdown
        dropdown.innerHTML = option;
    })
}).catch(err => {
    console.log(err);
});







