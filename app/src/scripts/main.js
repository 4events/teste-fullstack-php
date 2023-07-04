$(document).ready(function () {
    fetchVehicles();
    loadEvents();
});

function loadEvents(){
    $('#inputSearch').on('keypress', function(event) {
        if (event.which == 13) {
            query = $('#inputSearch').val()
            if(!query) {alert('Digite um veículo'); return false}
            searchVehicle(query)
        }
    });

    $('#btn-search').on('click', function() {
        query = $('#inputSearch').val()
        if(!query) {alert('Digite um veículo'); return false}
        searchVehicle(query)
    });
}

async function fetchVehicles() {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/vehicles');
        if (response.ok) {
            const data = await response.json();
            loadVehicles(data);
            handleLoadDetails();
            return { status: 200, data };
        } else {
            console.error(response);
            throw new Error('Error fetching vehicles.');
        }
    } catch (error) {
        console.error(error);
        $('#main-list').html('<div class="main-details-card"><div class="row"><div class="col-12"><p class="m-0">Nenhum veículo cadastrado!</p></div></div></div>')
        return { status: 400, error };
    }
}

async function fetchVehicle(id) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/vehicles/${id}`);
        if (response.ok) {
            const data = await response.json();
            let classSold = data.vendido === 0 ? "soldFalse" : "soldTrue";
            let vehicleDescription = `
            <div class="main-details-card">
                <div class="row">
                    <div class="col-12">
                        <h4 class="main-details-card-title">
                            ${data.veiculo}
                        </h4>
                        <div class="main-details-card-description">
                            <div class="row">
                                <div class="col-6">
                                    <div class="main-detais-card-description-marca-label">
                                        Marca
                                    </div>
                                    <div class="main-detais-card-description-marca-text">
                                    ${data.marca}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="main-detais-card-description-ano-label">
                                        Ano
                                    </div>
                                    <div class="main-detais-card-description-ano-text">
                                        ${data.ano}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="main-details-card-description-text">
                                    ${data.descricao}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                    <button id="btn-edit-vehicle" class="btn btn-secondary btn-edit" data-id='${data.id}'
                                        data-toggle="modal" data-target="#editVehicleModal">
                                        <i class="fa-solid fa-pen mr-3"></i>Editar
                                    </button>
                                </div>
                                <div class="col-2 main-details-card-icon">
                                    <i class="fa-solid fa-tag ${classSold}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `

            $('#main-details').html('');
            $('#main-details').append(vehicleDescription);

            $('#inputEditId').val(data.id);
            $('#inputEditVeiculo').val(data.veiculo);
            $('#inputEditMarca').val(data.marca);
            $('#inputEditAno').val(data.ano);
            if (data.vendido == 1) {
                $('#inputEditVendido').prop('checked', true);
            } else {
                $('#inputEditVendido').prop('checked', false);
            }
            $('#inputEditDescricao').val(data.descricao);

            console.log(data);
            return { status: 200, data };
        } else {
            console.error(response);
            throw new Error('Error fetching vehicle.');
        }
    } catch (error) {
        console.error(error);
        $('#main-details').html('<div class="main-description-card"><div class="row"><div class="col-12"><p>Nenhum descrição cadastrada!</p></div></div></div>')
        return { status: 400, error };
    }
}

async function searchVehicle(query) {
    if (!query) return false

    try {
        const response = await fetch(`http://127.0.0.1:8000/api/search/${query}`);
        if (response.ok) {
            const data = await response.json();

            console.log(data);

            if (Object.keys(data).length === 0) {return false}

            $('#main-list').html('');

            let cardVehicle = '';

            data.forEach((item, index) => {
                let classSold = item.vendido === 0 ? "soldFalse" : "soldTrue";
                cardVehicle = `
                                <div class="main-list-card" id="${item.id}">
                                    <div class="row">
                                        <div class="col-10">
                                            <h4 class="main-list-card-title">
                                                ${item.marca}
                                            </h4>
                                            <h5 class="main-list-card-description">
                                            ${item.veiculo}
                                            </h5>
                                            <p class="main-list-card-year">
                                            ${item.ano}
                                            </p>
                                        </div>
                                        <div class="col-2 main-list-card-icon">
                                            <i class="fa-solid fa-tag ${classSold}"></i>
                                        </div>
                                    </div>
                                </div>        
                            `
                $('#main-list').append(cardVehicle);

                handleLoadDetails();
            })
            return { status: 200, data };
        } else {
            console.error(response);
            throw new Error('Error searching vehicle.');
        }
    } catch (error) {
        console.error(error);
        return { status: 400, error };
    }
}

function loadVehicles(data) {

    if (Object.keys(data).length === 0) {return false}

    let cardVehicle = '';

    data.forEach((item, index) => {
        let classSold = item.vendido === 0 ? "soldFalse" : "soldTrue";
        cardVehicle = `
                        <div class="main-list-card" id="${item.id}">
                            <div class="row">
                                <div class="col-10">
                                    <h4 class="main-list-card-title">
                                        ${item.marca}
                                    </h4>
                                    <h5 class="main-list-card-description">
                                    ${item.veiculo}
                                    </h5>
                                    <p class="main-list-card-year">
                                    ${item.ano}
                                    </p>
                                </div>
                                <div class="col-2 main-list-card-icon">
                                    <i class="fa-solid fa-tag ${classSold}"></i>
                                </div>
                            </div>
                        </div>        
                    `
        $('#main-list').append(cardVehicle);
    })
}

function loadVehicleDetails(id) {
    fetchVehicle(id);
}

function handleLoadDetails() {
    $(".main-list-card").click(function (event) {
        let id = event.currentTarget.id
        loadVehicleDetails(id)
    });
}

function validateAddVehicleForm() {
    const form = $('#form-add-vehicle');
    form.validate();

    if (form.valid()) {
        // Form is valid, set the input colors to blue
        form.find('input, textarea').css('border-bottom-color', '#818181');

        addNewVehicle();

    } else {
        // Form is not valid, set the input colors to red for empty fields
        form.find('input, textarea').each(function () {
            if ($(this).val() === '') {
                $(this).css('border-bottom-color', '#dc3545');
            } else {
                $(this).css('border-bottom-color', '#818181');
            }
        });

        // Show an alert
        alert('Preencha todos os campos');
        console.error('Form is not valid');
    }
}

function validateEditVehicleForm() {
    const form = $('#form-edit-vehicle');
    form.validate();

    if (form.valid()) {
        // Form is valid, set the input colors to blue
        form.find('input, textarea').css('border-bottom-color', '#818181');

        editVehicle();

    } else {
        // Form is not valid, set the input colors to red for empty fields
        form.find('input, textarea').each(function () {
            if ($(this).val() === '') {
                $(this).css('border-bottom-color', '#dc3545');
            } else {
                $(this).css('border-bottom-color', '#818181');
            }
        });

        // Show an alert
        alert('Preencha todos os campos');
        console.error('Form is not valid');
    }
}

async function addNewVehicle() {
    vehicle = $('#inputVeiculo').val();
    brand = $('#inputMarca').val();
    year = Number($('#inputAno').val());
    sold = $('#inputVendido').is(':checked') ? 1 : 0;
    description = $('#inputDescricao').val();

    if (!vehicle || !brand || !year || !description) {
        console.error('Missing parameters');
        return false;
    }

    const body = new URLSearchParams();
    body.append('veiculo', vehicle);
    body.append('marca', brand);
    body.append('ano', year);
    body.append('descricao', description);
    body.append('vendido', sold);

    try {
        const response = await fetch("http://127.0.0.1:8000/api/vehicles/", {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': '*/*'
            },
            method: "POST",
            body: body,
        });
        if (response.ok) {
            console.log("Success:", response.status);
            const data = await response.json();
            let classSold = data.vendido === 0 ? "soldFalse" : "soldTrue";
            cardVehicle = `
                            <div class="main-list-card" id="${data.id}">
                                <div class="row">
                                    <div class="col-10">
                                        <h4 class="main-list-card-title">
                                            ${data.marca}
                                        </h4>
                                        <h5 class="main-list-card-description">
                                        ${data.veiculo}
                                        </h5>
                                        <p class="main-list-card-year">
                                        ${data.ano}
                                        </p>
                                    </div>
                                    <div class="col-2 main-list-card-icon">
                                        <i class="fa-solid fa-tag ${classSold}"></i>
                                    </div>
                                </div>
                            </div>        
                        `
            $('#main-list').append(cardVehicle);

            console.log(data);
            return data;
        } else {
            console.log("Error:", response.status);
        }
    } catch (error) {
        alert('Não foi possível cadastrar o veículo! Por favor entre em contato com o administrador.')
        console.error(error);
    } finally {
        $('#addVehicleModal').modal('hide');
    }
}

async function editVehicle() {
    id = $('#inputEditId').val();
    vehicle = $('#inputEditVeiculo').val();
    brand = $('#inputEditMarca').val();
    year = Number($('#inputEditAno').val());
    sold = $('#inputEditVendido').is(':checked') ? 1 : 0;
    description = $('#inputEditDescricao').val();

    if (!vehicle || !brand || !year || !description) {
        console.error('Missing parameters');
        return false;
    }

    const body = new URLSearchParams();
    body.append('veiculo', vehicle);
    body.append('marca', brand);
    body.append('ano', year);
    body.append('descricao', description);
    body.append('vendido', sold);

    try {
        const response = await fetch(`http://127.0.0.1:8000/api/vehicles/${id}`, {
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Accept': '*/*'
            },
            method: "PATCH",
            body: body,
        });
        if (response.ok) {

            const data = await response.json();

            $(`#${id} .main-list-card-title`).html(`${data.vehicle.marca}`);
            $(`#${id} .main-list-card-description`).html(`${data.vehicle.veiculo}`);
            $(`#${id} .main-list-card-year`).html(`${data.vehicle.ano}`);

            $(`.main-details-card-title`).html(`${data.vehicle.veiculo}`);
            $(`.main-detais-card-description-marca-text`).html(`${data.vehicle.marca}`);
            $(`.main-detais-card-description-ano-text`).html(`${data.vehicle.ano}`);
            $(`.main-details-card-description-text`).html(`${data.vehicle.descricao}`);


            if (data.vehicle.vendido == 1) {
                $(`#${id} .main-list-card-icon .fa-tag`).addClass('soldTrue').removeClass('soldFalse');
                $(`.main-details-card-icon .fa-tag`).addClass('soldTrue').removeClass('soldFalse');
            } else {
                $(`#${id} .main-list-card-icon .fa-tag`).addClass('soldFalse').removeClass('soldTrue');
                $(`.main-details-card-icon .fa-tag`).addClass('soldFalse').removeClass('soldTrue');
            }
            $('#inputEditDescricao').val(data.descricao);

            console.log(data.vehicle);
            return data;
        } else {
            console.log("Error:", response.status);
        }
    } catch (error) {
        alert('Não foi possível editar o veículo! Por favor entre em contato com o administrador.')
        console.error(error);
    } finally {
        $('#editVehicleModal').modal('hide');
    }
}