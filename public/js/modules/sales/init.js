$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

elementProperty.addEventInElement('.show-products','onclick',function () {
    let totalValue = 0;
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
                totalValue = (totalValue + item.value);
                console.log(item.value)
                return `
                    <tr>
                        <th>${item.name}</th>
                        <td>${item.description}</td>
                        <td>${Mask.maskMoney(item.value)}</td>
                    </tr>
                `;
            })
            elementProperty.getElement('#value-total', total => {
                total.innerHTML = 'R$ '+ Mask.maskMoney(totalValue);
            })
        });
    })

})
