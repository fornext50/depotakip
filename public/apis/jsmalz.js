$(document).ready(function(){
	var url = window.location.origin+'/malzemeler';

	$('#btn-add-mal').click(function() {
		$('#hata').hide();
		$('#btn-save').val("add");
		$('#frmMalz').trigger("reset");
		$('#md-malz').modal('show');
	});

	$('.btn-edit').click(function(event) {
		var m_id = $(this).val();
		$.get(url + '/' + m_id+'/edit',function (data) {

			$('#m_id').val(data.id);
			$('#mkimlik').val(data.mkimlik);
			$('#madi').val(data.madi);
			$('#mgrubu').val(data.mgrubu);
			$('#mmarka').val(data.mmarka);
			$('#mmodel').val(data.mmodel);
			$('#c2').val(data.mfiyat);
			$('#mdurum').val(data.mdurum);
			$('#mozellik').val(data.mozellik);
			$('#btn-save').val('update');
			$('#md-malz').modal('show');
		});
	});

	$('#btn-save').click(function (e) {
		$('#hata').hide();
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
			}
		});
		e.preventDefault();

		var formData =  {
			mkimlik : $('#mkimlik').val(),
			madi : $('#madi').val(),
			mgrubu : $('#mgrubu').val(),
			mmarka : $('#mmarka').val(),
			mmodel : $('#mmodel').val(),
			mfiyat : $('#c2').val(),
			mdurum : $('#mdurum').val(),
			mozellik : $('#mozellik').val(),
			ip : window.location.host
		};

		var state = $('#btn-save').val();
		var m_id = $('#m_id').val();
		var type = "POST";
		var my_url = url;
		
		if(state == "update")
		{
			type = "PUT";
			my_url += "/" + m_id;
		}

		$.ajax({
			url: my_url,
			type: type,
			dataType: 'json',
			data: formData,
			success: function(data){
				/*
				var malz = '<tr id="mal-' + data.id + '">'+
                           '<td>'+ data.mkimlik +'</td>'+
                           '<td>'+ data.madi +'</td>'+
                           '<td>'+ data.mgrubu +'</td>'+
                           '<td>'+ data.mdurum +'</td>'+
                           '<td>'+ data.mozellik+'</td>'+
                           '<td><button value="'+data.id+'" class="btn btn-warning btn-circle btn-detail btn-edit"><i class="fa fa-edit"></i></button>'+
                           '<button value="'+data.id+'" class="btn btn-danger btn-circle btn-delete delete-malz"><i class="fa fa-times"></i></button></td></tr>';
				$('#mal-list').append(malz);
				*/
				$('#frmMalz').trigger('reset');
				$('#md-malz').modal('hide');
				location.reload();
			},
			error: function (xhr) {
				var msg = "Beklenmedik bir hata";
				if(xhr.status == 404){
					var json = xhr.responseJSON;
					var b = JSON.parse(JSON.stringify(json.mesaj));
					msg = "<ul>";
					$.each(b,function(i,val){
						msg += "<li>"+ val + "</li>";
					});
					msg += "</ul>";
				}
				if(xhr.status == 500){
					var json = xhr.responseJSON;
					var b = JSON.parse(JSON.stringify(json.mesaj));
					msg = b;
				}
				$('#hata').show();
				$('#hata').html(msg);
			}
		});
	});
	
	$('.delete-malz').click( function (e){
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content')
			}
		});
		var m_id = $(this).val();
		swal({
			title : "Silmek istiyor musunuz?",
			text: "Bu kaydın malzeme hareketleri varsa onlarda silenecek devam etmek istiyor musunuz?",
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
						location.reload();
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