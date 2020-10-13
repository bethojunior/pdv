class UserController extends ConnectionServer{
    static delete(id)
    {
        return new Promise(resolve => {
            this.sendRequest('user/'+id,'DELETE',null,resolve,true)
        })
    }
}
