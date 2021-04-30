function addGoods(this_){
	var formdata = new FormData(this_.closest('form'));
	var color = formdata.get('color');
	var size = formdata.get('size');
	var id_good = $(this_).closest('form').attr('id-good');
	var count = formdata.get('quantity');
	console.log(id_good);
	console.log(count);

		$.ajax({
			type: 'POST',
			url:'index.php',
			headers:{"X-Requested-With": "XMLHttpRequest"},
			data:{pageAjax: 'basket', id_good: id_good, count: count, size: size, color: color},
			success: function(response){
				var arr =[];

				if(Array.isArray(response)){
					arr = response;

				}else{

					for(var key in response){
						arr.push(response[key]);
					}
				}

			var quant;
			var totalPrice;
			var descr;
			var totalSum=0;
			var totalQuant=0;
			for(var i=0; i<arr.length;i++){
				quant = arr[i]['quantity'];
				descr = arr[i]['description'];
				totalPrice = parseFloat(arr[i]['price'])*parseInt(quant,10);

				totalSum += totalPrice;
				totalQuant += parseInt(quant,10);
			}
			totalSum = parseFloat(totalSum.toFixed(2));

			$('.total').html(totalSum);
			$('.count_goods').html(totalQuant);

			},
			dataType:"json"
		});
}

function delItem(e) {
	event.stopPropagation();
	console.log('delitem');
	var id = $(e).parent().attr('id');
	console.log(id);
	$.ajax({
		type: 'POST',
		url:'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},
		data:{
			pageAjax:'delitem',
			id_good: id
		}, success: function(response){
			$('#listgoods').remove();
			console.log(response);
			var arr=[];
			if(Array.isArray(response)){
				arr = response;
				console.log('массив');
			}else{
				console.log('объект');
				for(var key in response){
					arr.push(response[key]);
				}
			}
			var basket = new Basket('listgoods',arr);

			basket.render('.modal-body');

	},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		}, dataType: 'json'
	})
}

function clearBasket() {
	$.ajax({
		type: 'POST',
		url: 'index.php',
		data:{
			pageAjax:'clearBasket'
		}, success: function(response){
			console.log(response);
			var arr=[];
				$('#listgoods').remove();
				var basket = new Basket('listgoods',arr);
				basket.render('.modal-body');

		}, dataType: 'json'
	});
}

function showBasket(){
	$.ajax({
		type: 'POST', url: 'index.php', data:{pageAjax: 'showBasket'},
		success: function(response){
			console.log(response);
			var arr=[];
			if(Array.isArray(response)){
				arr = response;
				console.log('массив');
			}else{
				console.log('объект');
				for(var key in response){
					arr.push(response[key]);
				}
			}

				var basket = new Basket('listgoods',arr);

				basket.render('.modal-body');


		},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		}, dataType:"json"
	});
}
function toOrder(){
	$.ajax({
		type:'POST',
		url: 'index.php'
	})
}
function Auth() {


	var formdata = new FormData(document.forms.auth);
	var login = formdata.get('login');
	var pass = formdata.get('pass');
	var mem = formdata.get('remember');
	$.ajax({
		type:'POST',
		url:'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},
		data:{
			login:login,
			pass:pass,
			mem:mem,
			pageAjax:'auth'},

		success: function (response) {
			console.log(response);
				if(response['success']===true){
					window.location.reload(true);
				}if(response['success']===false){
					alert('Неверный логин или пароль');
				}if(response['success']==='empty'){
					alert('Пустая форма');
				}

		},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		},dataType:'json'
	})
}
function logOut(){

	$.ajax({
		type:'POST',
		url:'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},
		data:{
			pageAjax:'logout'},
		success: function (response) {
			if(response['logout']===true){
				window.location.reload(true);
			}
		},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
			},dataType:'json'
	})

}
function regUser() {
	var formdata = new FormData(document.forms.auth);
	var login = formdata.get('login');
	var pass = formdata.get('pass');

	$.ajax({
		type:'POST',
		url:'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},
		data:{
			login:login,
			pass:pass,
			pageAjax:'reguser'},

		success: function (response) {
			switch(response['success']){
				case 'hadreg':
					window.location.reload(true);
					break;
				case 'double':
					alert('Такой логин занят!');
					break;
				case 'empty':
					alert('Заполните форму');
			}


		},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		},dataType:'json'
	})
}
function editGoods(e) {
	//$('form[name=edit_block]').off('change','**');
	var id = $(e).attr('id');
	$.ajax({
		type: 'POST',
		url:'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},
		data:{
			id: id,
			pageAjax:'editgoods'
		},
		success: function (response) {
			console.log(response);
			//var st_name = response['style_name'].match(/(\b\w+\b)/ig);
			var edit_block = new EditBlock(response[0],id);
			 //edit_block.render();
			if (edit_block.render()){
				$('form[name=edit_block]').on('change','input[name=style],input[name=size]',function(){
					checkWritten($(this).val(),$(this).attr('name'));
				})
			}


		},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		},dataType:"json"
	})
}

function checkWritten(str,field) {
	/*$('form[name=edit_block]').on('change','input[name=style],input[name=size]',function(){
    console.log($(this).val());
})*/
	str = str.match(/(\b\w+\b)/ig);

	$.ajax({
		type: 'POST',
		url: 'index.php',
		headers: {"X-Requested-With": "XMLHttpRequest"},
		data: {
			pageAjax: 'checkdata',
			arData: str,
			field: field
		}, success: function (response) {
			console.log(response);
			if (response) {
				return response;
			}
		}, error: function (error1, error2, error3) {
			console.log(error1);
			console.log(error2);
			console.log(error3);
		}, datatype: 'json'
	});
}

function saveEdit(form, this_,path) {
	var formdata = new FormData(form);
	var price = formdata.get('price');
	var description = formdata.get('description');
	var quantity = formdata.get('quantity');
	var id = $(form).attr('id');
	var size = formdata.get('size');
	var style = formdata.get('style');
	var path = path;

	size = size.match(/(\b\w+\b)/ig);
	style = style.match(/(\b\w+\b)/ig);

	$.ajax({
		type: 'POST',
		url: 'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},

		data:{
			pageAjax:'saveedit',
			price:price,
			description: description,
			quantity:quantity,
			id:id,
			img: path
		},
		success: function (response) {

			updateBlock(this_,'.items-1',response[0]);
			$('.btn-secondary').trigger('click');

		},error: function(error1,error2,error3){
		console.log(error1);
		console.log(error2);
		console.log(error3);
	},dataType:"json"
	});

}
function loadFile(files,this_,callback)
 {
	event.stopPropagation();
	event.preventDefault();
	var data_file = new FormData();
	$.each(files, function (key, value) {
		data_file.append(key,value);

	});

	data_file.append('pageAjax','uploadfile');


	 $.ajax({
		url         : 'index.php',
		type        : 'POST',
		data        : data_file,
		cache       : false,
		processData : false,
		contentType : false,
		success     : function( response){
			if(response['status']===true){
				 var pathI = '/'+response['path'];
					callback(pathI);
			}if(response['status']==='ERROR UPLOAD'){
				alert('Только изображения');
			}

		},

		error: function( error1,error2,error3 ){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		},dataType    : "json",

	});

}

function filter(style,size,price) {
	var style = style;
	var size = size;
	var price = price;
	console.log(style,size,price);
	$.ajax({
		type: 'POST',
		url: 'index.php',
		headers:{"X-Requested-With": "XMLHttpRequest"},

		data:{
			pageAjax:'filterform',
			price:price,
			style:style,
			size:size
		},
		success: function (response) {
			console.log(response +' filter');

				$('.items_products').each(function () {
					$(this).children().remove();
				});


			for(var i = 0;i <response.length;i++){
				var edit_block = new EditBlock(response[i]);
				edit_block.itemblock();
			}

		},error: function(error1,error2,error3){
			console.log(error1);
			console.log(error2);
			console.log(error3);
		},dataType:"json"
	});
}
