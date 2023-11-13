const getCities = () => {
       
    if(zipcode.value.length == 5){

        let newForm = new FormData();
        newForm.append('zipcode', zipcode.value)

        let options = {
            method: 'POST',
            body: newForm
        }

        fetch('/controllers/ajaxZipCode-ctrl.php', options)
        .then((response) => {
            return response.json();
        })
        .then((cities) => {
            citySelect.innerHTML = '';
            cities.forEach(city => {
                citySelect.innerHTML +=`<option>${city.nomCommune}</option>`
            });
        })
    }
}


zipcode.addEventListener('keyup', getCities)