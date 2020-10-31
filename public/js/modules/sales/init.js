$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

let totalValue = 0;
let tableSelected;

elementProperty.addEventInElement('.show-products','onclick',function () {
    totalValue = 0;
    elementProperty.getElement('#mount-products-by-table',these => {
        these.innerHTML = '';
    })
    let data = JSON.parse(this.getAttribute('data'));
    tableSelected = data;
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
    console.log()
    $('#modal-products').modal('hide');
    let value = Mask.maskMoney(totalValue);
    value = Mask.removeMaskMoney(value);
    let formData = new FormData();
    formData.append('id' , tableSelected.id);
    formData.append('value' , value);
    formData.append('user' , tableSelected.user_id);
    formData.append('date' , tableSelected.updated_at);
    formData.append('table' , tableSelected.table);
    formData.append('products' , JSON.stringify(tableSelected.products));
    SwalCustom.dialogConfirm('Deseja finalizar mesa?','Vai encerrar e deixar a mesa aberta',status => {

        if(!status)
            return true;

        SalesController.closed(formData).then(response => {
            console.log(response)

            if(!response.status)
                return swal('Erro ao fechar mesa','Contate o suporte 24 hrs','info')

            elementProperty.getElement('.table'+tableSelected.id,table => {
                table.style.display = 'none';
            })

            return swal('Mesa encerrada com sucesso','','success');
        })
    })

});


