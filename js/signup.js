
let dropdown = document.querySelector('#country-dropdown');
//fetching data from API
fetch('https://restcountries.com/v3.1/all').then(res => {
    return res.json();
}).then(data => {
    let option = '';
    data.forEach(country => {
        //adding country flag and cuntry name for each data
        option += `<option>${country.flag}  ${country.name.common}</option>`;
        //adding options to dropdown
        dropdown.innerHTML = option;
    });
}).catch(err => {
    console.log(err);
});


