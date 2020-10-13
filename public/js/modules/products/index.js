Mask.setMoneyField('#value-product');

elementProperty.addEventInElement('#add-new-product','onclick',function () {
    $('#modal-add-product').modal('show')
})

elementProperty.addEventInElement('.delete-item','onclick',function () {
    let id = this.getAttribute('id');
    let that = this;
    SwalCustom.dialogConfirm('Deseja deletar esse produto?','Essa ação é irreversivel',status => {
        if(!status)
            return false;

        ProductController.delete(id).then(response => {
            if(!response.status)
                return swal('Erro ao excluir','Contate o suporte','info')
            swal('Excluido com sucesso','','success')
            return elementProperty.getElement('.product'+id,that => {
                that.style.display = 'none'
            });
        })
    })
})
