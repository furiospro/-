
/*опции:
* id блока
* положение при загрузке
* цвет
* скорость
* */
function expandBlock(id,block,bool,col, time1, height=432) {

	var time = time1;
	var color = col;
	var b = bool;
	var i = '';
	var heightContainer = height;
	var first_child = $(id).firstChild;
	var disappBlock = block;

	var onloadHeight= heightContainer/16;
	onloadHeight.toFixed(3);

	i = onloadHeight;
	var moveUp;
	var moveDown;
	function defaultOption(){
		if(!time){
			time=1;
		}
		if(!color){
			color = ['#ef5b70','#6f6e6e']
		}
		if(!bool){
			bool = false;
		}

	}
	defaultOption();


	$(id)
		.addClass('block_active')
		.children('p').css('color',color[0])
		.next('.category_triangle')
		.addClass('category_triangle_expand');
		$(disappBlock).css('display', 'flex');

	if(!b){
		$(id)
			.removeClass('block_active')
			.children(first_child).css('color',color[1])
			.next('.category_triangle')
			.removeClass('category_triangle_expand');

		$(disappBlock).css({
				'display': 'none',
				'height': 0
			}
		);
		i = 0;
		b = false;
	}

	$(id).on('click',function() {



		if (!b) {

			$(first_child).css('color', color[0]);
			$(id)
				.addClass('block_active')
				.children('.category_triangle')
				.addClass('category_triangle_expand')
				.css('border-top-color', '#ef5b70');

			$(disappBlock).css({
					'display': 'flex',
					'flex-direction':'column'
			});


			var display = function () {
				clearTimeout(moveUp);
				moveDown = setTimeout(function () {
					$(disappBlock).css('height', i + 'em');
					i++;

					if (i <= onloadHeight) {
						display();
					}
				}, time);
			};
			display();
			b = true;

		} else {
			clearTimeout(moveDown);
			var hidden = function () {
				moveUp = setTimeout(function () {
					$(id)
						.children('.category_triangle')
						.removeClass('category_triangle_expand');
					i--;
					$(disappBlock).css('height', i + 'em');

					if (i > 0) {
						hidden();
					}
					if (i === 0) {

						$(disappBlock).css({
							'display': 'none',
							'height': '0'
						});
						$(first_child).css('color', color[1]);
						$(id)
							.removeClass('block_active')
							.children('.category_triangle')
							.css('border-top-color', '#6f6e6e');

					}
				}, time);
			};
			hidden();
			b = false;
		}
	});

}
