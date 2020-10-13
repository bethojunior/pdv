elementProperty.addEventInElement('#add-new-user','onclick',function () {
    $('#modal-add-user').modal('show')
})

elementProperty.addEventInElement('.delete-user','onclick',function () {
    let id = this.getAttribute('id');
    let that = this;
    SwalCustom.dialogConfirm('Deseja deletar esse usuário?','Essa ação é irreversivel',status => {
        if(!status)
            return false;

        UserController.delete(id).then(response => {
            if(!response.status)
                return swal('Erro ao excluir','Contate o suporte','info')
            swal('Excluido com sucesso','','success')
            return elementProperty.getElement('.user'+id,that => {
                that.style.display = 'none'
            });
        })
    })
})
