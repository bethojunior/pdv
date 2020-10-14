class SalesController extends ConnectionServer{

    static closed(id)
    {
        return new Promise(resolve => {
            this.sendRequest('sale/'+id,'DELETE',null,resolve,true);
        })
    }
}
