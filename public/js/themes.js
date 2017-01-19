$(document).ready(function(){
    $('#deletemalzeme').on('click', function(e) {
        swal({
                title: "Kayıt Silme?",
                text: "Seçili kaydı silmek istiyor musunuz?",
                type: "error",
                cancelButtonText: "Hayır",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Evet",
                closeOnConfirm: false
            },
            function(){
                swal({
                    title:"Başarılı!",
                    text:"Silme işlemi tamamlandı",
                    type:"success",
                    confirmButtonText:"Tamam",
                    timer:750
                });
            });
    });

});


$('#newmal').on('click',function(){
    $('#mdmalzeme').modal('show');
});
