BX.ready(async () => {
    const houseSelect = document.getElementById('house-select');
    const apartmentSelect = document.getElementById('apartment-select');

    const housesResponse = await BX.ajax.runAction('lsr:module.HouseController.list');

    housesResponse.data.forEach(house => {
        houseSelect.add(new Option(house.NAME, house.ID));
    });

    houseSelect.addEventListener('change', async (event) => {
        const houseId = event.target.value;

        apartmentSelect.innerHTML = '';

        if (!houseId) {
            apartmentSelect.disabled = true;
            apartmentSelect.add(new Option('Сначала выберите дом', ''));
            return;
        }

        try {
            const response = await BX.ajax.runAction('lsr:module.ApartmentController.list', {
                data: {
                    houseId: houseId
                }
            });

            apartmentSelect.add(new Option('Выберите квартиру', ''));

            response.data.forEach(apartment => {
                const option = new Option(apartment.NUMBER, apartment.ID);
                option.disabled = apartment.STATUS === 'sold';

                apartmentSelect.add(option);
            });

            apartmentSelect.disabled = false;
        } catch (error) {
            console.error(error);

            apartmentSelect.add(new Option('Ошибка загрузки', ''));
        }
    });

    const formMessage = document.getElementById('form-message');

    function showMessage(type, text) {
        formMessage.className = `form-message ${type}`;
        formMessage.textContent = text;
    }

    const form = document.getElementById('request-form');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = Object.fromEntries(new FormData(form));

        data.apartmentId = Number(data['apartment-select']);

        try {
            const response = await BX.ajax.runAction('lsr:module.RequestController.create', {data});

            showMessage('success', response.data);

            form.reset();

            apartmentSelect.disabled = true;
        } catch (error) {
            const message = error.errors?.[0]?.message || 'Ошибка';

            showMessage('error', message);
            return;
        }
    });
});
