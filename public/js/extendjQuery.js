$.SidebarToggle = {}

$.SidebarToggle.options = {
	EnableRemember: true
}

$(function () {
	'use strict'

	// document.cookie = 'toggleSidebar=open';
	// var re = new RegExp('toggleSidebar' + "=([^;]+)")
	// var value = re.exec(document.cookie)
	// console.log(value)
	// console.log(unescape(value[1]))
	// console.log(document.cookie)

	$('body').on('collapsed.lte.pushmenu', function() {
		if ($.SidebarToggle.options.EnableRemember) {
			document.cookie = 'toggleSidebar=collapsed';
		}
	})
	$('body').on('shown.lte.pushmenu', function() {
		if ($.SidebarToggle.options.EnableRemember) {
			document.cookie = 'toggleSidebar=expanded';
		}
	})

	$.fn.extend({
		getData: function() {
			var data = {};
			var field = $(this).find('input, select');
			for (var i=0; i < field.length; i++) {
				var key = field[i].name;
				var value = field[i].value;
				data[key] = value;
			}
			return data;
		},
		active: 0,
		len: 0,
		paginate: function(param, my_callback) {
			var len = param.length ? param.length : 0;
			var active = param.active ? param.active : 0;
			var lbl = param.label ? param.label : {};
			var lbl_next = lbl.next!==false ? true:lbl.next;
			var lbl_prev = lbl.previous!==false ? true:lbl.previous;

			this.active = active;
			this.len = len;					

			var that = $(this).html(`
				<li class="page-item page-first"><a class="page-link" href="#" title="First">
					<i class="fas fa-backward"></i></a>
				</li>
				<li class="page-item page-prev">
					<a class="page-link" href="#">
						<i class="fas fa-chevron-left"></i>${lbl_prev ? ' Prev':''}
					</a>
				</li>
				<li class="page-item"><a class="page-link is-active" href="#">-- of --</a></li>

				<li class="page-item page-next">
					<a class="page-link" href="#">
						${lbl_next ? 'Next ':''}<i class="fas fa-chevron-right"></i>
					</a>
				</li>
				<li class="page-item page-last"><a class="page-link" href="#" title="Last">
					<i class="fas fa-forward"></i></a>
				</li>
			`);

			if (active <= 1 || len ==0) {
				$(this).find('.page-first:first, .page-prev:first').css({
					'pointer-events': 'none', 'opacity': 0.5
				});
			}

			if (len == active || len ==0) {
				$(this).find('.page-last:first, .page-next:first').css({
					'pointer-events': 'none', 'opacity': 0.5
				});
			}

			$(this).find('.is-active:first').text(`${active} of ${len}`);

			var that = this;
			$(this).find('.page-next:first').on('click', function(e) {
				if (that.active < that.len) {
					that.paginate({'length': that.len, 'active':that.active+1});
					my_callback(that.active);
				}
			});
			$(this).find('.page-prev:first').on('click', function(e) {
				if (that.active > 1) {
					that.paginate({'length': that.len, 'active':that.active-1});
					my_callback(that.active);
				}
			});
			$(this).find('.page-last:first').on('click', function(e) {
				if (that.active < that.len) {
					that.paginate({'length': that.len, 'active':that.len});
					my_callback(that.active);
				}
			});
			$(this).find('.page-first:first').on('click', function(e) {
				if (that.active > 1) {
					that.paginate({'length': that.len, 'active':1});
					my_callback(that.active);
				}
			});
		},
		getEditor: function(param) {
			if ($('.my-editor-modal').length) {
				return false;
			}
			var that = this;
			var title = param.title ? param.title : 'Editor';
			var icon = param.icon ? param.icon : 'fa-question-circle';
			var btn_ok = param.okButton ? param.okButton : 'Confirm';
			var btn_cancel = param.cancelButton ? param.cancelButton : {};
			var btn_cancel_show = btn_cancel.visible===false ? btn_cancel.visible : true;
			var btn_cancel_text = btn_cancel.text ? btn_cancel.text : 'Cancel';
			var size = param.width ? param.width : 'medium';
			var sizes = {
				'small': 'modal-sm',
				'medium': 'modal-md',
				'large': 'modal-lg',
			}
			var wid = sizes[size] ? sizes[size] : 'modal-md';

			var mod = `
				<div class="modal my-editor-modal" id="my-editor" style="background-color: #00000047;z-index: 9999;display:block !important;">
					<div class="modal-dialog ${wid}">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" style="font-size: 14px;">
									<i class="fas ${icon}"></i> ${title}
								</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<textarea name="my-editor-field" id="my-editor-field"></textarea>
								</div>
							</div>
							<div class="modal-footer justify-content-between" style="padding: 2px 15px;">
								${btn_cancel_show===true?`<button type="button" class="btn btn-danger btn-sm btn-editor-cancel"><i class="fas fa-times-circle"></i> ${btn_cancel_text}</button>`:''}
								<button type="button" form="" class="btn btn-primary btn-sm btn-editor-ok">
									<i class="fas fa-check-circle"></i>	
									${btn_ok}
								</button>
							</div>
						</div>
					</div>
				</div>
			`;

			$('body').append(mod);
			
			// $('#my-editor').modal('show');

			$('#my-editor-field').summernote({
				height: 150
			});
			$('div.note-btn-group.btn-group.note-insert').remove();
			$('div.note-btn-group.btn-group.note-table').remove();
			$('div.note-btn-group.btn-group.note-view .btn-codeview').remove();

			$('.my-editor-modal').find('.btn-editor-cancel:first').on('click', function() {
				$('#my-editor').remove();
			})
			$('.my-editor-modal').find('.btn-editor-ok:first').on('click', function() {
				var editor_value = $('#my-editor-field').val();
				if (!editor_value || editor_value.trim('')=='') {
					alert('Cannot add with empty data.');
				}
				else {
					$('.my-editor-modal').remove();
					$(that).html(editor_value);
				}
				
			})
		}
	});


	$.extend({
		formatDate: function(d) {
			// var m = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
			// d = new Date(d);
			// var yy = d.getFullYear();
			// var mm = d.getMonth();
			// var dd = d.getDate();
			// return m[mm]+' '+dd+', '+yy;
			
			d = new Date(d);
			var yy = d.getFullYear();
			var mm = d.getMonth()+1;
			var dd = d.getDate();
			return mm+'/'+dd+'/'+yy;
		},
		toastfire: function(tf = {}) {
			const Toast = Swal.mixin({
	      toast: true,
	      position: tf.position ? tf.position : 'top-end',
	      showConfirmButton: false,
	      timer: tf.timer ? tf.timer : 3000
	    });
	    Toast.fire({
        icon: tf.icon ? tf.icon : 'success',
        title: tf.title ? tf.title : 'Title'
      });
		},
		loading: {
			show: function(param={}) {
				var title = param.title?param.title:'Loading...';
				var div = `
					<div id="ajax-loader" class="loader-wrap" style="position: fixed;background: #d3d3d38f;top: 0;bottom: 0;left: 0;right: 0;z-index: 99999; cursor:wait;">
						<div class="loader-body" style="border: 1px solid grey;position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);background: white;padding: 30px 50px; cursor:default;">
							<i class="fas fa-spinner fa-spin" style="font-size: 18px;"></i>
							<span>${title}</span>
						</div>
					</div>
				`;
				$('body').append(div);
			},
			hide: function() {
				$('#ajax-loader').remove();
			}
		},
		onCofirm: function(param) {
			var elem = param.elem ? param.elem : 'Confirmation';
			var title = param.title ? param.title : 'Confirmation';
			var icon = param.icon ? param.icon : 'fa-question-circle';
			var btn_ok = param.okButton ? param.okButton : 'Confirm';
			var btn_cancel = param.cancelButton ? param.cancelButton : {};
			var btn_cancel_show = btn_cancel.visible===false ? btn_cancel.visible : true;
			var btn_cancel_text = btn_cancel.text ? btn_cancel.text : 'Cancel';
			var size = param.width ? param.width : 'medium';
			var autoClose = param.autoClose===false ? param.autoClose : true;
			var sizes = {
				'small': 'modal-sm',
				'medium': 'modal-md',
				'large': 'modal-lg',
			}
			var wid = sizes[size] ? sizes[size] : 'modal-md';

			var mod = `
				<div class="modal" data-backdrop="false" id="confirmme-123" style="background-color: #00000047;z-index: 9999;">
					<div class="modal-dialog ${wid}" style="top: 30%;transform: translateY(-30%);border-radius:0;">
						<div class="modal-content" style="border-radius: 0;">
							<div class="modal-header" style="padding: 10px 15px;background-color: #d3d3d37a;border-radius: 0;">
								<h4 class="modal-title" style="font-size: 14px;">
									<i class="fas ${icon}"></i> ${title}
								</h4>
							</div>
							<div class="modal-body" style="max-height: calc(100vh - 150px);overflow: auto;">
								<form id="formme-123">
								${elem}
								</form>
							</div>
							<div class="modal-footer justify-content-between" style="padding: 2px 15px;background-color: #d3d3d37a;border-radius: 0;">
								${btn_cancel_show===true?`<button type="button" class="btn btn-danger btn-sm btn-flat btnme-123-cancel"><i class="fas fa-times-circle"></i> ${btn_cancel_text}</button>`:''}
								<button type="button" form="" class="btn btn-primary btn-sm btn-flat btnme-123-ok">
									<i class="fas fa-check-circle"></i>	
									${btn_ok}
								</button>
							</div>
						</div>
					</div>
				</div>
			`;
			$('body').append(mod);
			$('#confirmme-123').modal('show');

			$('#confirmme-123').find('.btnme-123-cancel:first').on('click', function() {
				$('#confirmme-123').modal('hide');
				setTimeout(function() {
					$('#confirmme-123').remove();
				}, 500);
				if (param.onCancel) {
					param.onCancel();
				}
			})
			$('#confirmme-123').find('.btnme-123-ok:first').on('click', function() {
				var data = {};
				$('#formme-123').find('input, select').each(function(i, elem) {
					if ($(elem).attr('type') == 'checkbox') {
						data[elem.name?elem.name:i] = $(elem).prop('checked');
					}
					else {
						data[elem.name?elem.name:i] = elem.value?elem.value:null;
					}
				});
				param.onOkay(data);

				if (autoClose === true) {
					$('#confirmme-123').modal('hide');
					$('#confirmme-123').remove();
					// setTimeout(function() {
					// 	$('#confirmme-123').remove();
					// }, 500);
				}
			})


			if (param.onInit) {
				param.onInit();
			}
		}
	})
});
