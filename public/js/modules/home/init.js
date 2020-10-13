elementProperty.addEventInElement('.open-ticket','onclick',function () {
    let data = JSON.parse(this.getAttribute('data'));

    $('#modal-info-ticket').modal('show');

    elementProperty.getElement('#title-ticket-modal', title => {
        title.innerHTML = data.enterprise_name;
    });

    elementProperty.getElement('#title-ticket', title => {
        title.value = data.title;
    });

    elementProperty.getElement('#api-type-ticket', app => {
        app.value = data.appname;
    });

    elementProperty.getElement('#description-ticket', description => {
        description.value = data.description;
    });
});

elementProperty.addEventInElement('.badge-modal-info','onclick',function () {
    let data = JSON.parse(this.getAttribute('data-browse'));
    elementProperty.getElement('#body-modal-status',these => {
        let content = data.map(item => {
            return `
                <tr>
                    <th>${item.id}</th>
                    <th>
                        <label class="badge badge-info">${item.status_ticket}</label>
                    </th>
                    <th>${item.title}</th>
                    <th>${item.enterprise_name}</th>
                </tr>
            `;
        }).join('');
        these.innerHTML = content;
    })
})

elementProperty.addEventInElement('.open-ticket-complete','onclick',function (e) {
    e.stopPropagation();
    let id = this.getAttribute('id');
    window.location.href = '/ticket/timeline/'+ id;
})
