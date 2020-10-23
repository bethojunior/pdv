$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

let totalValue = 0;

elementProperty.addEventInElement('.show-products','onclick',function () {
    $('#modal-products').modal('show')
    totalValue = 0;
    let data = JSON.parse(this.getAttribute('data'));

    elementProperty.getElement('#mount-products', tbody => {
        let content = '';
        tbody.innerHTML = content;
        data.map(item => {
            let products = item.product;
            content += products.map(product => {
                totalValue = totalValue + product.value;
                return `
                    <tr>
                        <th>${product.name}</th>
                        <td>${product.description}</td>
                        <td>${Mask.maskMoney(product.value)}</td>
                    </tr>
                `
            });
        }).join('');

        tbody.innerHTML = content;
        elementProperty.getElement('#value-total-sale' , total => {
            total.innerHTML = 'R$ '+Mask.maskMoney(totalValue);
        })
        console.log(totalValue)
    })
})

elementProperty.addEventInElement('#print-table','onclick',function () {
    var content_print = document.getElementById('table-for-print').innerHTML
    screen_print = window.open('');

    screen_print.document.write(content_print);
    screen_print.window.print();
    // screen_print.window.close();
})
