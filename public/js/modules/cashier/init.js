$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
let selected = []
let totalValue = 0;

elementProperty.addEventInElement('.show-products','onclick',function () {
    selected = [];
    $('#modal-products').modal('show')
    totalValue = 0;
    let products = JSON.parse(this.getAttribute('products'));
    let data = JSON.parse(this.getAttribute('data'));
    console.log(data)
    console.log(products)

    elementProperty.getElement('#mount-products', tbody => {
        let content = '';
        tbody.innerHTML = ' ';
        products.map(item => {
            let products = item.product;

            content += products.map(product => {
                selected.push(product);
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
    })

})

elementProperty.addEventInElement('#data-print' ,'onclick', that => {
    selected.map(item => {
        item.total = 'R$ '+Mask.maskMoney(totalValue);
        item.value = 'R$ '+Mask.maskMoney(item.value)
    });
    printJS({
        printable: selected,
        properties: [
            { field: 'name', displayName: 'Produto',columnSize : 4},
            { field: 'description', displayName: 'Descrição',columnSize : 4},
            { field: 'value', displayName: 'Valor',columnSize : 4}
        ],
        header: `<h3 class="custom-h3">Total R$ ${Mask.maskMoney(totalValue)}</h3>`,
        style: '.custom-h3 { color: red; text-align:center }',
        type: 'json'
    })
})
