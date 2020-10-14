class SalesController extends ConnectionServer{

    static closed(data)
    {
        return new Promise(resolve => {
            this.sendRequest('sale','POST',data,resolve,true);
        })
    }
}
