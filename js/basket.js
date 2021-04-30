function Basket(idBasket, response) {
	this.id = idBasket;
	this.response = response;

}


//Basket.prototype.constructor = Basket;
Basket.prototype.render = function (j) {
	console.log(this.response);
	if(this.response.length >0){

		console.log(this.response);
		var totalSum=0;
		var totalQuant=0;
		var $basketDiv = $('<div />',{
			id:this.id,
		});
		var $control = $('<div />',{
			id: 'control'
		});
		$control.css({
			'display': 'flex',
			'justify-content': 'space-between',
			'padding': '0 15px'
		});

		var $s = $('<span />',{id: 'clear',class:'btn btn-primary',text:'Очистить', css:{'cursor':'pointer'},on:{
				click: function(){
					clearBasket();
				}
			}});
		$basketDiv.appendTo(j);


		for(var i=0;i< this.response.length;i++){
			var totalPrice = parseFloat(this.response[i]['price'])*parseInt(this.response[i]['quantity'],10);
			var $str = $('<p />',{
				id: this.response[i]['id_good'],
				text: 'Наименование: '+this.response[i]['description'] + '; Цена: '+this.response[i]['price']+'; Количество '+this.response[i]['quantity']+ '; Итого: '+totalPrice
			});
			var $del = $('<span />',{
				id:'del-item',
				text:'&#169;'
			});
			$str.append('<span id ="del-item" onclick="delItem(this)">&#10008;</span>');
			totalSum += totalPrice;
			totalQuant += parseInt(this.response[i]['quantity']);
			$str.appendTo($basketDiv);
		}
		$basketDiv.append('<p id="basket-list"><span>Количетсво товаров '+totalQuant +' </span><span>На сумму: '+ totalSum+'</span></p>');
		$('.modal-footer').css({
			'justify-content': 'space-between'
		});

		$basketDiv.append($s);
		$control.appendTo($basketDiv);
		basketPreview(totalSum,totalQuant);
	}else{

		console.log(this.response);
		$('.modal-body').append('<div><p style="font-size:1.6em">Корзина пуста</p></div>');
		basketPreview();
	}

};



Basket.prototype.loadBasket = function () {
	console.log('asd');
	var $goods = $('<p />',{
		text: 'Всего товаров:' + this.countGoods}
	);
	var $amount = $('<p />',{
		text:'Общая сумма:' + this.amount
	});
	var appendId = '#'+this.id+'_items';

		var $basketData = $('<div />', {
			id: 'basket_data'
		});
		console.log('asd2');
		$basketData.append($goods);
		$basketData.append($amount);
		$basketData.appendTo(appendId);


};


Basket.prototype.refresh = function () {
	var $basketItems = $('#basket_items');
	var $basketData = $('<div />', {
		id: 'basket_data'
	});
	$basketItems.empty();//очищаем содержимое контейнера
	$basketData.append('<p>Всего товаров:'+this.countGoods+'</p>');
	$basketData.append('<p>Общая сумма:'+this.amount+'</p>');
	$basketData.appendTo($basketItems);
};

Basket.prototype.remove = function (e) {
	var id = $(this).parent().attr('id');

	this.countGoods--;
	this.amount -= price;
	this.basketItems.splice(index,1);

/*$('#del-item').on('click',function(){

		console.log($(this).parent().attr('id'));
	})*/
};
