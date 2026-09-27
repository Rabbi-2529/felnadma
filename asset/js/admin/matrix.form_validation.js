
$(document).ready(function(){

	$("#access").hide();
	$("#type").change(function(){
		var type = $("#type").val();
		if (type == "Admin") {
			$("#access").hide();
		}
		else {
			$("#access").show();
		}
	});


	$("#new_pass").click(function(){
		var current_pass = $("#current_pass").val();
		if (current_pass != '') {
			$.ajax({
					type: 'get',
					url: '/admin/check_pass',
					data: {current_pass:current_pass},
					success: function(resp){
						if (resp == "false") {
							$("#check_status").html("<font color='red'>Current Password Is Incorrect</font>");
						}
					}
			});
		}
	});

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();

	$('select').select2();

	// Form Validation
    $("#add_logo").validate({
		rules:{
			logo:{
				required:true,
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_hidden_image").validate({
	rules:{
		image:{
			required:true,
		}
	},
	errorClass: "help-inline",
	errorElement: "span",
	highlight:function(element, errorClass, validClass) {
		$(element).parents('.control-group').addClass('error');
	},
	unhighlight: function(element, errorClass, validClass) {
		$(element).parents('.control-group').removeClass('error');
		$(element).parents('.control-group').addClass('success');
	}
});

	$("#add_header_contact").validate({
		rules:{
			phone:{
				required:true,
			},

			email:{
				required:true,
				email:true
			},
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});



	$("#add_nav_item").validate({
		rules:{
			nav_item:{
				required: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	$("#add_slider").validate({
	rules:{
		slider_image:{
			required:true,
		}
	},
	errorClass: "help-inline",
	errorElement: "span",
	highlight:function(element, errorClass, validClass) {
		$(element).parents('.control-group').addClass('error');
	},
	unhighlight: function(element, errorClass, validClass) {
		$(element).parents('.control-group').removeClass('error');
		$(element).parents('.control-group').addClass('success');
	}
});

$("#add_sms_offer").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_marketing_image").validate({
rules:{
	title:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_sms_marketing_benefits").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_why_choose_us").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_facilities").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_customer_support_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	phone:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_parent_link").validate({
rules:{
	title:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});



$("#edit_header_contact").validate({
rules:{
	phone:{
		required:true,
	},

	email:{
		required:true,
		email:true
	},
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});



$("#edit_nav_item").validate({
rules:{
	nav_item:{
		required: true
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});


$("#edit_sms_offer").validate({
rules:{
title:{
required:true,
},

description:{
required:true,
}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});

$("#edit_marketing_image").validate({
rules:{
title:{
required:true,
}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});

$("#edit_sms_marketing_benefits").validate({
rules:{
title:{
required:true,
},

description:{
required:true,
}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});

$("#edit_why_choose_us").validate({
rules:{
title:{
required:true,
},

description:{
required:true,
}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});

$("#edit_facilities").validate({
rules:{
title:{
required:true,
},

description:{
required:true,
}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});

$("#edit_customer_support_info").validate({
rules:{
title:{
required:true,
},

description:{
required:true,
},

phone:{
required:true,
}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
$(element).parents('.control-group').removeClass('error');
$(element).parents('.control-group').addClass('success');
}
});

$("#edit_parent_link").validate({
rules:{
	title:{
	required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_footer_link").validate({
rules:{
	parent_id:{
		required:true
	},
	title:{
		required:true
	},
	url:{
		required:true
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_footer_link").validate({
rules:{
	parent_id:{
		required:true,
	},
	title:{
		required:true,
	},
	url:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_price_header_info").validate({
rules:{
	header_title:{
		required:true,
	},
	description:{
		required:true,
	},
	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_price_header_info").validate({
rules:{
	header_title:{
		required:true,
	},
	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_package").validate({
rules:{
	package_no:{
		required:true,
	},
	package_name:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_package").validate({
rules:{
	package_no:{
		required:true,
	},
	package_name:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_price_info").validate({
rules:{
	package_id:{
		required:true,
	},
	sms_type1:{
		required:true,
	},
	sms_type2:{
		required:true,
	},
	sms_type3:{
		required:true,
	},
	sms_type4:{
		required:true,
	},
	sms_type5:{
		required:true,
	},
	sms_type6:{
		required:true,
	},
	sms_type7:{
		required:true,
	},
	sms_type8:{
		required:true,
	},
	sms_type9:{
		required:true,
	},
	sms_type10:{
		required:true,
	},
	price1:{
		required:true,
	},
	price2:{
		required:true,
	},
	price3:{
		required:true,
	},
	price4:{
		required:true,
	},
	price5:{
		required:true,
	},
	price6:{
		required:true,
	},
	price7:{
		required:true,
	},
	price8:{
		required:true,
	},
	price9:{
		required:true,
	},
	price10:{
		required:true,
	},
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_price_info").validate({
rules:{
	package_id:{
		required:true,
	},
	sms_type1:{
		required:true,
	},
	sms_type2:{
		required:true,
	},
	sms_type3:{
		required:true,
	},
	sms_type4:{
		required:true,
	},
	sms_type5:{
		required:true,
	},
	sms_type6:{
		required:true,
	},
	sms_type7:{
		required:true,
	},
	sms_type8:{
		required:true,
	},
	sms_type9:{
		required:true,
	},
	sms_type10:{
		required:true,
	},
	price1:{
		required:true,
	},
	price2:{
		required:true,
	},
	price3:{
		required:true,
	},
	price4:{
		required:true,
	},
	price5:{
		required:true,
	},
	price6:{
		required:true,
	},
	price7:{
		required:true,
	},
	price8:{
		required:true,
	},
	price9:{
		required:true,
	},
	price10:{
		required:true,
	},
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_reseller_header_info").validate({
rules:{
	header_title:{
		required:true,
	},
	description:{
		required:true,
	},
	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_reseller_header_info").validate({
rules:{
	header_title:{
		required:true,
	},
	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_reseller_info").validate({
rules:{
	feature:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_reseller_info").validate({
rules:{
	feature:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_reseller_image").validate({
rules:{
	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_terms").validate({
rules:{
	header_title:{
		required:true,
	},
	terms:{
		required:true,
	},
	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_terms").validate({
rules:{
	header_title:{
		required:true,
	},
	terms:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_about_info").validate({
rules:{
	header_title:{
		required:true,
	},
	description:{
		required:true,
	},
	image:{
		required:true,
	},
	logo:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_about_info").validate({
rules:{
	header_title:{
		required:true,
	},
	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_contact_info").validate({
rules:{
	office_name:{
		required:true,
	},
	address:{
		required:true,
	},
	mobile:{
		required:true,
	},
	hotline:{
		required:true,
	},
	phone:{
		required:true,
	},
	email:{
		required:true,
	},
	skype:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_contact_info").validate({
rules:{
	office_name:{
		required:true,
	},
	address:{
		required:true,
	},
	mobile:{
		required:true,
	},
	hotline:{
		required:true,
	},
	phone:{
		required:true,
	},
	email:{
		required:true,
	},
	skype:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_meta_tag").validate({
rules:{
	meta_title:{
		required:true,
	},
	meta_description:{
		required:true,
	},
	meta_keywords:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_meta_tag").validate({
rules:{
	meta_title:{
		required:true,
	},
	meta_description:{
		required:true,
	},
	meta_keywords:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});


$("#add_seo_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_seo_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_flexi_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_flexi_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#add_fb_marketing_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	},

	image:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

$("#edit_fb_marketing_info").validate({
rules:{
	title:{
		required:true,
	},

	description:{
		required:true,
	}
},
errorClass: "help-inline",
errorElement: "span",
highlight:function(element, errorClass, validClass) {
	$(element).parents('.control-group').addClass('error');
},
unhighlight: function(element, errorClass, validClass) {
	$(element).parents('.control-group').removeClass('error');
	$(element).parents('.control-group').addClass('success');
}
});

	$("#password_validate").validate({
		rules:{
			current_pass:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pass:{
				required: true,
				minlength:6,
				maxlength:20
			},
			confirm_pass:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pass"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

	// $(".deleteRecord").click(function(){
	// 	var id = $(this).attr('rel');
	// 	var deleteFunction = $(this).attr('rell');
	// 	swal({
	// 			  title: 'Are you sure?',
	// 			  text: "You won't be able to revert this!",
	// 			  type: 'warning',
	// 			  showCancelButton: true,
	// 			  confirmButtonColor: '#3085d6',
	// 			  cancelButtonColor: '#d33',
	// 			  confirmButtonText: 'Yes, delete it!'
	// 			},
	// 			function(){
	// 				window.location.href="/admin/"+deleteFunction+"/"+id;
	// 			});
	// });

});
