$(document).ready(function($) {
	var url = window.location.origin+'/gruptanim';
	$('body').append(getModel('Grup Tanımlama'));

	$('#btn-add-grp').click(function(e) {
		e.preventDefault();
		$('#hata').hide();
		$('#btn-save').val("add");		
		$('#md-grup').modal('show');
		frmReset();
	});

	$('#btn-save').click(function (e){ //begin save
		$('#hata').hide();
		$.ajaxSetup({ headers:{ "X-CSRF-TOKEN" : $('meta[name="_token"').attr('content') } });
		e.preventDefault();
		var formData = { grpname : $('#grpadi').val() };
		var state = $('#btn-save').val();
		var gid = $('#grpid').val();
		var type = "POST";
		var my_url = url;

		if(state == "update") { type = "PUT"; my_url += "/"+gid; }

		$.ajax({
			url: my_url,
			type: type,
			dataType: 'json',
			data: formData,
			success: function(data){
				frmReset();
				$('md-grup').modal('hide');
				location.reload();
			},
			error: function (xhr){
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
	}); //endsave

	$('.btn-delete').click(function (e){
		$.ajaxSetup({ headers: { "X-CSRF-TOKEN" : $('meta[name="_token"]').attr('content') } });
		var m_id = $(this).val();

		swal({
			title : "Silmek istiyor musunuz?",
			text: "Grup silinecek devam etmek istiyor musunuz?",
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

	$('.btn-edit').click(function (e){
		var gid = $(this).val();
		var myurl = url + '/' + gid + '/edit';
		$.get(myurl,function (data){
			$("#grpid").val(data.id);
			$('#grpadi').val(data.name);
			$('#btn-save').val('update');
			$('#md-grup').modal('show');
		});
	});

	$('.btn-active').click(function(e){
		$.ajaxSetup({
			headers: {
				"X-CSRF-TOKEN" : $('meta[name="_token"').attr('content')
			}
		});

		var m_id = $(this).val();
		var my_url = window.location.origin + '/gruptanim';
		type = "DELETE";
		var formData = {
			gpid : m_id,
			durum: 'active'
		}

		$.ajax({
			url: my_url + '/' + m_id,
			type : type,
			dataType : 'json',
			data : formData,
			success: function(data){
				location.reload();
			},
		});

	});

});

function frmReset(){
	$("#grpid").val('');
	$('#grpadi').val('');
}

function getModel(state){
	var deger = $('#md-grup');
	if(deger.length > 0 ) return;
	var modal = '<div class="modal fade" id="md-grup"> '+
				'<div class="modal-dialog" role="document">'+
				'	<div class="modal-content">'+
				'		<div class="modal-header">'+
				'			<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
				'				<span aria-hidden="true">&times;</span>'+
				'				<span class="sr-only">Close</span>'+
				'			</button>'+
				'			<h4 class="modal-title">'+state+'</h4>'+
				'		</div>'+
				'		<div class="modal-body">'+
				'			<div class="form-group">'+
				'				<label  class="control-label">Grup Adı</label>'+
				'				<input id="grpadi" type="text" class="form-control" name="grpadi" required autofocus>'+
				'			</div>'+
				'		<div class="alert alert-danger" id="hata" role="alert" hidden></div>'+
				'		</div>'+
				'		<div class="modal-footer">'+
				'			<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>'+
				'			<button id="btn-save" type="button" class="btn btn-primary">Kaydet</button>'+
				'		</div>'+
				'		<input type="hidden" id="grpid" name="grpid" value="0">'+
				'	</div><!-- /.modal-content -->'+
				'</div><!-- /.modal-dialog -->'+
				'</div><!-- /.modal -->';
	return modal;
}