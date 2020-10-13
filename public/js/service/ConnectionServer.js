class ConnectionServer {

    static Host() {
        return HOST.hosts.web;
    }

    static HostApi() {
        return HOST.hosts.api;
    }

    /**
     *
     * @param endPoint
     * @param method
     * @param formData
     * @param resolve
     * @param api
     * @param isFormData
     * @returns {Promise<Response>}
     */
    static sendRequest(endPoint,method = 'GET',formData,resolve,api = false,isFormData = false)
    {
        if(isFormData){
            formData.append('_token', document.querySelector(`meta[name='csrf-token']`)
                .getAttribute('content'));
        }

        var myHeaders = new Headers({
            "X-Requested-With": "XMLHttpRequest",
        });

        var myInit = {
            method: method,
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData,
        };

        if(api){
            return fetch(ConnectionServer.HostApi()+endPoint,myInit)
                .then(function(response) {
                    resolve(response.json())
                })
                .catch(function(error) {
                    resolve(error)
                });
        }
        return fetch(ConnectionServer.Host()+endPoint,myInit)
            .then(function(response) {
                resolve(response.json())
            })
            .catch(function(error) {
                resolve(error)
            });

    }

    /**
     *
     * @param url
     * @param method
     * @param resolve
     */
    static simpleRequest(url,method,resolve){
        $.ajax({
            url : url,
            method: method,
            success: function (response) {
                resolve(response)
            }
        })
    }

}
