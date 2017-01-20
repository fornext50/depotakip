$(document).ready(function(){
	var url = window.location.origin+'/hareketler';

	$('#btn-add-mc').click(function(e) {
		$('#hata').hide();
		$('#btn-save').val("add");
		$('#frmMalc').trigger('reset');
		$('#md-mc').modal('show');
	});

	$('.btn-edit').click(function(event){
		var m_id = $(this).val();
		$.get(url + '/' + m_id + '/edit',function (data){
			$('#m_id').val(data.malzeme_id);
			$('#mcikaran').val(data.cikaran_kisi);
			$('#mcikarilan').val(data.cikarilan_kisi);
			$('#ctarih').val(data.cikarma_tarihi);
			$('#cgerekce').val(data.gerekce);
			$('#caciklama').val(data.aciklama);	
			$('#btn-save').val('update');
			$('#md-mc').modal('show');
		});
	});

	$('#btn-save').click(function(e) {
		$('#hata').hide();
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"').attr('content')
			}
		});
		e.preventDefault();

		var formData = {
			malzeme_id : $('#m_id').val(),
			cikaran_kisi : $('#mcikaran').val(),
			cikarilan_kisi : $('#mcikarilan').val(),
			gerekce : $('#cgerekce').val(),
			cikarma_tarihi : $('#ctarih').val(),
			aciklama : $('#caciklama').val(),
			ip : window.location.host //localhostfalan yazacak olmadı bence :/
		};

		var state = $('#btn-save').val();
		var m_id = $('#m_id').val();
		var type = "POST";
		var my_url = url;
		console.log(my_url);

		if(state == "update"){
			type = "PUT";
			my_url += "/" + m_id;
		}


		$.ajax({
			url : my_url,
			type : type,
			dataType : 'json',
			data : formData,
			success: function(data){
				$('#frmMalc').trigger('reset');
				$('#md-mc').modal('hide');
			},
			error: function (error) {
				$('#hata').show();
				$('#hata').text('Hata detayları yazılacak');
			}
		});
	});


	$('.delete-malc').click( function (e){
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
			}
		});
		var m_id = $(this).val();
		swal({
			title : "Kayıt Silme",
			text: "Seçili kaydı silmek istiyor musunuz?",
			type: "warning",
			cancelButtonText: "Hayır",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Evet",
			closeOnConfirm: false
		},function(){
			$.ajax({
					type: "DELETE",
					url: url + '/' + m_id,
					success: function (data) {
						swal({
			                    title:"Başarılı!",
			                    text:"Silme işlemi tamamlandı",
			                    type:"success",
			                    confirmButtonText:"Tamam",
			                    timer:1000
			                });
					},
					error: function (data){
						swal({
			                    title:"Başarısız!",
			                    text:"Silme işlemi tamamlanmadı!." + data.msg,
			                    type:"error",
			                    confirmButtonText:"Tamam",
			                    timer:2000
			                });
					}
				});
		});
	});
});