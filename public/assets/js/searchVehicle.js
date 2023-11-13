const getVehicles = () => {

    let newForm = new FormData();
    newForm.append('search', search.value)

    let options = {
        method: 'POST',
        body: newForm
    }

    fetch('/controllers/dashboard/vehicles/ajaxGetVehicles-ctrl.php', options)
        .then((response) => {
            return response.json();
        })
        .then((vehicles) => {
            vehiclesList.innerHTML = '';
            vehicles.forEach(vehicle => {
                let isDeleted = (vehicle.deleted_at) ? 'deleted' : '';
                let tr = `
                    <tr class="` + isDeleted + `">
                        <td><a href="/controllers/dashboard/categories/update-ctrl.php?id_categories=${vehicle.id_categories}">${vehicle.name}</a></td>
                        <td>`;
                if(vehicle.picture){
                    tr += `
                        <a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=${vehicle.id_vehicles}">
                            <img class="thumb" src="/public/uploads/vehicles/${vehicle.picture}">
                        </a>
                    `;
                }
                tr += `
                    </td>
                        <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=${vehicle.id_vehicles}">${vehicle.brand}</a></td>
                        <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=${vehicle.id_vehicles}">${vehicle.model}</a></td>
                        <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=${vehicle.id_vehicles}">${vehicle.registration}</a></td>
                        <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=${vehicle.id_vehicles}">${vehicle.mileage}</a></td>
                        <td class="text-center">
                            <a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicles=${vehicle.id_vehicles}"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a href="/controllers/dashboard/vehicles/delete-ctrl.php?id_vehicles=${vehicle.id_vehicles}"><i class="fa-regular fa-trash-can"></i></a>
                        </td>
    
                    </tr>`;
                
                vehiclesList.innerHTML += tr;

            });




            console.log(vehicles);
        })

}

search.addEventListener('keyup', getVehicles)