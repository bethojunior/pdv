$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

elementProperty.addEventInElement('.show-products','onclick',function () {
    elementProperty.getElement('#mount-products-by-table',these => {
        these.innerHTML = '';
    })

    let products = JSON.parse(this.getAttribute('products'));

    $('#modal-products').modal('show');

    elementProperty.getElement('#mount-products-by-table',these => {
        these.innerHTML = '';
        products.map(item => {
            elementProperty.getElement('#number-table',these => {
                these.innerHTML = item.table;
            })
            let data = item.product;
            these.innerHTML += data.map(item => {
                return `
                    <tr>
                        <th>${item.name}</th>
                        <td>${item.description}</td>
                        <td>${Mask.maskMoney(item.value)}</td>
                    </tr>
                `;
            })
        });
    })

})
