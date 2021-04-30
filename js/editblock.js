function EditBlock(response,id) {
	this.img = response['img'];
	this.price = response['price'];
	this.description = response['description'];
	this.quantity = response['quantity'];
	this.id = response['id_good'];
	this.size = response['size_name'];
	this.style = response['style_name'];
}

// Создание блока редиктирования
EditBlock.prototype.render = function () {

	var text = ({
			image:'Введите картинку',
			price:'Введите цену',
			description:'Введите описание',
			quantity:'Введите количество',
			size:'Введите размер',
			style:'Введите стиль'
		});

	var edit_div = $('<div />',{
		class: 'edit_div'
	});
	var img = $('<img />',{
		src: this.img
	});

	var prev_img = $('<div />',{
		class: 'prev_img'
	});
	img.appendTo(prev_img);
	var arr_fields = ([
		$('<input />', {
			type: 'file',
			name: 'image',
			id:'input_image',
			class: 'insert_image',
			multiple:'multiple',
			value: this.img,

		}),
		$('<input />', {
			type: 'text',
			name: 'price',
			class: 'input_price',
			value: this.price
		}),
		$('<input />', {
			type: 'text',
			name: 'description',
			class: 'input_description',
			value: this.description,

		}),
		$('<input />', {
			type: 'text',
			name: 'quantity',
			class: 'input_quantity',
			value: this.quantity
		}),
		$('<input />', {
			type: 'text',
			name: 'size',
			class: 'input_size',
			value: this.size
		}),
		$('<input />', {
			type: 'text',
			name: 'style',
			class: 'input_style',
			value: this.style
		})
	]);

	var form = $('<form />',{
		name:'edit_block',
		class: 'form_edit',
		id:this.id
	});

		for(var i=0;i<arr_fields.length;i++){
			var label = $('<label />',{
				class: 'modal_edit_input_'+arr_fields[i].attr('name'),
				for:arr_fields[i].attr('id'),
				text: text[arr_fields[i].attr('name')]
			});
			label.append(arr_fields[i]);
			form.append(label);
		}
		$(edit_div).append(form);
		$(edit_div).append(prev_img);
		$('.modal-body').append(edit_div);
		return form;


};
EditBlock.prototype.itemblock = function () {
	var div_cont = $('<div />',{
		class:'items-1_products',
		id:this.id
	});
	var div_shad =  $('<div />',{
		class:'shadow'
	});
	var div_sh_cont = $('<div />',{
		class:'sh-cont'
	});
	var a = $('<a />',{
		class:'cart-link',
		href:'href="/product/single?'+this.id+'"',
		target:'_blank'
	});
	var icon = $('<img >',{
		src:'../img/Forma_1.png'
	});
	var span = $('<span />',{
		class:'add-to-cart',
		text:'add-to-cart'
	});
	var img = $('<img >',{
		src:this.img
	});
	var p_desc = $('<p />',{
		class:'description',
		text: this.description
	});
	var p_price = $('<p />',{
		class:'price',
		text: this.price
	});

	icon.appendTo(a);
	span.appendTo(a);
	a.appendTo(div_sh_cont);
	div_sh_cont.appendTo(div_shad);
	div_shad.appendTo(div_cont);
	img.appendTo(div_cont);
	p_desc.appendTo(div_cont);
	p_price.appendTo(div_cont);
	div_cont.appendTo($('.items_products'));
};