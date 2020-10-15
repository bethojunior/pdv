$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

elementProperty.addEventInElement('.show-products','onclick',function () {
    $('#modal-products').modal('show')
    let data = JSON.parse(this.getAttribute('data'));

    elementProperty.getElement('#mount-products', tbody => {
        let content = '';
        tbody.innerHTML = content;
        data.map(item => {
            let products = item.product;
            content += products.map(item => {
                return `
                    <tr>
                        <th>${item.name}</th>
                        <td>${item.description}</td>
                        <td>${Mask.maskMoney(item.value)}</td>
                    </tr>
                `
            });
        }).join('');

        tbody.innerHTML = content;
    })
})
