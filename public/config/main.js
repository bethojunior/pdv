function getEnvironment(){
    const environments = [
        {
            name: "http://127.0.0.1:8000/",
            hosts : {
                web : 'http://127.0.0.1:8000/',
                api : 'http://127.0.0.1:8000/api/',
            }
        }, {
            name: "https://pdv.madgic.com.br/",
            hosts : {
                web : 'https://pdv.madgic.com.br/',
                api : 'https://pdv.madgic.com.br/api/',
            }
        },

    ];

    return environments.filter(environment=>{
        return document.URL.includes(environment.name)
    })[0];
}
const VERSION   = 'v1.0';
const HOST = getEnvironment();
const PATH_IMAGE = HOST.name+'storage/profiles/';
