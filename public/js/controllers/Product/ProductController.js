class ProductController extends ConnectionServer{
    static delete(id)
    {
        return new Promise(resolve => {
            this.sendRequest('product/'+id,'DELETE',null,resolve,true)
        })
    }
}
