$(document).ready(function(){
	var url = window.location.origin+'/hareketler';
	$('#monay').click(function(e){
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"').attr('content')
			}
		});

		var m_id = $(this).val();
		var my_url = window.location.origin + '/malzemeler';
		type = "DELETE";
		var formData = {
			malzeme_id : m_id,
			durum: 'onay'
		}

		$.ajax({
			url: my_url + '/' + m_id,
			type : type,
			dataType : 'json',
			data : formData,
			success: function(data){
				swal('Başarılı','Malzeme Çıkış Onaylandı','success');
				location.reload();
			},
		});

	});
	$('#btn-add-mc').click(function(e) {
		$('#hata').hide();
		$('#btn-save').val("add");
		$('#btn-save').show();
		$('#frmMalc').trigger('reset');
		$('#md-mc').modal('show');
	});

	$('.btn-edit').click(function(event){
		var m_id = $(this).val();
		$.get(url + '/' + m_id + '/edit',function (data){
			$('#m_id').val(data.malzeme_id);
			$('#mcikaran').val(data.cikaran_kisi);
			$('#mcikarilan').val(data.cikarilan_kisi);
			$('#tbirim').val(data.tesim_birimi);
			$('#ctarih').val(data.cikarma_tarihi);
			$('#cgerekce').val(data.gerekce);
			$('#caciklama').val(data.aciklama);	
			$('#btn-save').show();
			$('#btn-save').val('update');
			$('#md-mc').modal('show');
		});
	});
	$('.btn-view').click(function(event){
		var m_id = $(this).val();
		$.get(url + '/' + m_id + '/edit',function (data){
			$('#m_id').val(data.malzeme_id);
			$('#mcikaran').val(data.cikaran_kisi);
			$('#mcikarilan').val(data.cikarilan_kisi);
			$('#tbirim').val(data.tesim_birimi);
			$('#ctarih').val(data.cikarma_tarihi);
			$('#cgerekce').val(data.gerekce);
			$('#caciklama').val(data.aciklama);	
			$('#btn-save').hide()
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
			cikarilan_kisi : $('#mcikarilan').val(),
			gerekce : $('#cgerekce').val(),
			cikarma_tarihi : $('#ctarih').val(),
			aciklama : $('#caciklama').val(),
			teslim_birimi : $('#tbirim').val(),
			ip : window.location.host //localhostfalan yazacak olmadı bence :/ Dediğim gibi ama Model Tarafında o iş halloluyor :)
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
				location.reload();
			},
			error: function (xhr) {
				var msg = "HATA!!";
				if(xhr.status == 404){
					var json = xhr.responseJSON;
					var b = JSON.parse(JSON.stringify(json.mesaj));
					msg = "<ul>";
					$.each(b,function(i,val){
						msg += "<li>"+ val + "</li>";
					});
					msg += "</ul>";
				}
				
				$('#hata').show();
				$('#hata').html(msg);
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
			title : "İptal Etme",
			text: "Seçili kaydı iptal etmek istiyor musunuz?",
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
			                    text:"İptal işlemi tamamlandı",
			                    type:"success",
			                    confirmButtonText:"Tamam",
			                    timer:1000
			                });
						location.reload();
					},
					error: function (data){
						swal({
			                    title:"Başarısız!",
			                    text:"İptal işlemi tamamlanmadı!." + data.msg,
			                    type:"error",
			                    confirmButtonText:"Tamam",
			                    timer:2000
			                });

					}
				});
		});
	});
});