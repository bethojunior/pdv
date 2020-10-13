$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

elementProperty.addEventInElement('.show-products','onclick',function () {
    let products = JSON.parse(this.getAttribute('products'));
    console.log(products)
})
