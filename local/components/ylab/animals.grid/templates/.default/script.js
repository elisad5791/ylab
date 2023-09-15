function deleteAnimal(elementId) {
    BX.ajax.runComponentAction('ylab:animals.grid', 'deleteAnimal', {
        mode: 'class',
        data: { id: elementId }
    }).then(function (response) {
        location.reload();
    }, function (response) {
        console.log('error');
        console.log(response);
    });
}

function editAnimal(elementId) {
    let addButton = document.querySelector('.add-button');
    let addForm = document.querySelector('#add-form');
    addButton.classList.add('d-none');
    addForm.classList.remove('d-none');
    BX.ajax.runComponentAction('ylab:animals.grid', 'editAnimal', {
        mode: 'class',
        data: { id: elementId }
    }).then(function (response) {
        data = response.data;
        addForm.querySelector('input[name="name"]').value = data['UF_NAME'];
        addForm.querySelector('input[name="origin"]').value = data['UF_ORIGIN'];
        addForm.querySelector('input[name="date"]').value = data['UF_DATE'];
        addForm.querySelector('select[name="kind"]').value = data['UF_KIND'];
        addForm.querySelector('select[name="gender"]').value = data['UF_GENDER'];
        addForm.querySelector('input[name="id"]').value = data['ID'];
    }, function (response) {
        console.log('error');
        console.log(response);
    });
}

BX.ready(function () {
    let addButton = document.querySelector('.add-button');
    let addForm = document.querySelector('#add-form');
    let newAnimal = document.querySelector('#new-animal');
    let saveButton = document.querySelector('#save-button');

    addButton.addEventListener('click', function (e) {
        addButton.classList.add('d-none');
        addForm.classList.remove('d-none');
    });

    saveButton.addEventListener('click', function (e) {
        let action = saveButton.dataset['action'];
        let formData = new FormData(newAnimal);
        let name = formData.get('name');
        let kind = formData.get('kind');
        let gender = formData.get('gender');
        let origin = formData.get('origin');
        let date = formData.get('date');
        let id = formData.get('id');
        BX.ajax.runComponentAction('ylab:animals.grid', action, {
            mode: 'class',
            data: { name, kind, gender, origin, date , id}
        }).then(function (response) {
            location.reload();
        }, function (response) {
            console.log('error');
            console.log(response);
        });

    });
});