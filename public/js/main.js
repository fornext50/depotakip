$(document).ready(function() {
	var url = window.location.origin;
	var profil = '	<div class="row"><form id="frmUser"><input type="text" id="uid" hidden>'+
							'		<div class="col-md-12">'+
								'		<div class="form-group">'+
								'			<label> Kullanıcı Adı </label><input id="username" type="text" class="form-control">'+
								'		</div>'+
								'		<div class="form-group">'+
								'			<label> Email </label><input id="email" type="email" class="form-control">'+
								'		</div>'+
							'		</form><div class="alert alert-danger" id="hata" role="alert" hidden></div></div>'+
							'	</div>';
	var sifre = '	<div class="row"><form id="frmSifre"><input type="text" id="uid" hidden>'+
							'		<div class="col-md-12">'+
							'		<div class="form-group">'+
							'			<label> Aktif Şifre </label><input id="oldpassword" type="password" class="form-control">'+
							'		</div>'+
							'		<div class="form-group">'+
							'			<label> Yeni Şifre </label><input id="newpassword" type="password" class="form-control">'+
							'		</div>'+
							'		<div class="form-group">'+
							'			<label> Yeni Şifre Tekrar  </label><input id="confirmpassword" type="password" class="form-control">'+
							'		</div>'+
							'		</form></div>'+
							'	</div>';
			
	modalForm('Profil Düzenle',profil,'profil');
	modalForm('Şifre Değiştir',sifre,'sifre');
	$('#profil').click(function(e) {
		$.get(url + '/profil',function (data) {
			$('#frmUser').trigger('reset');
			$('#username').val(data.name);
			$('#email').val(data.email);
			$('#uid').val(data.id);
		});
		$('#hata').hide();
		$("#modal-profil").modal('show');
	});
	$('#sifre').click(function(e) {
		$.get(url + '/profil',function (data) {
			$('#frmSifre').trigger('reset');
		});
		$('#hata').hide();
		$("#modal-sifre").modal('show');
	});

	$('#btnsave-profil').click(function(e) {
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"').attr('content')
			}
		});
		e.preventDefault();
		var formData = {
			uid : $('#uid').val(),
			username : $('#username').val(),
			mail : $('#email').val(),
		};

		$.ajax({
			url : url+'/profil',
			dataType : 'json',
			type : "PUT",
			data : formData,
			success: function (data){
				swal("Başarılı", "Güncelleme İşlemi Tamamlandı!", "success");
				$("#modal-profil").modal('hide');
			},
			error: function (xhr){
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

	$('#btnsave-sifre').click(function(e){
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"').attr('content')
			}
		});
		e.preventDefault();
		var formData = {
			oldpassword : $('#oldpassword').val(),
			newpassword : $('#newpassword').val(),
			confirmpassword : $('#confirmpassword').val()
		};

		$.ajax({
			url : url+'/passwordchange',
			dataType: 'json',
			type: 'POST',
			data:formData,
			success: function(data){
				$("#modal-sifre").modal('hide');
			}
		});
	});

	function modalForm (title,body,type){
		var htmlModal = '<div class="modal fade" id="modal-'+type+'"> '+
					'<div class="modal-dialog" role="document">'+
						'<div class="modal-content">'+
							'<div class="modal-header">'+
								'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
									'<span aria-hidden="true">&times;</span>'+
									'<span class="sr-only">Close</span>'+
								'</button>'+
								'<h4 class="modal-title">'+title+'</h4>'+
							'</div>'+
							'<div class="modal-body">'+
								body + 
							'</div>'+
							'<div class="modal-footer">'+
								'<button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>'+
								'<button type="button" id="btnsave-'+type+'" class="btn btn-success">Kaydet</button>'+
							'</div>'+
						'</div><!-- /.modal-content -->'+
					'</div><!-- /.modal-dialog -->'+
				'</div><!-- /.modal -->';
				$('body').append(htmlModal);
	}
});