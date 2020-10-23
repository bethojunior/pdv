if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js').then(function (registration) {
            console.log('ServiceWorker registration :', registration.scope);
        }).catch(function (error) {
            console.log('ServiceWorker registration failed:', errror);
        });
    });
}
