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

elementProperty.addEventInElement('.closed-table','onclick',function () {
    let id = this.getAttribute('id');
    SwalCustom.dialogConfirm('Deseja finalizar mesa?','Vai encerrar e deixar a mesa aberta',status => {
        if(!status)
            return true;

        SalesController.closed(id).then(response => {
            console.log(response)
            if(!response.status)
                return swal('Erro ao fechar mesa','Contate o suporte 24 hrs','info')

            elementProperty.getElement('.table'+id,table => {
                table.style.display = 'none';
            })

            return swal('Mesa encerrada com sucesso','','success');
        })
    })

});
