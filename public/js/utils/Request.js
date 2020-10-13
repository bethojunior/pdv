$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// $(document).ready(function(){
//     $("#valor").on('blur', function()
//     {
//         valor = $(this).val();
//         $.ajax({
//
//             type:'POST',
//             url:"{!! URL::to('/teste/valor') !!}",
//             dataType: 'JSON',
//             data: {
//                 "valor": valor
//             },
//             success:function(data){
//                 // Caso ocorra sucesso, como faço para pegar o valor
//                 // que foi retornado pelo controller?
//                 alert('Sucesso');
//             },
//             error:function(){
//                 alert('Erro');
//             },
//         });
//
//
//     });
// });
