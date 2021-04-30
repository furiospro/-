<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>BRAND Header 1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link href="/img/Group%202.png" rel="shortcut icon">
	<link rel="stylesheet" href="/node_modules/normalize.css/normalize.css">
	<link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">

	<link rel="stylesheet" href="/css/test-css.css">
	<link rel="stylesheet" href="/css/test1-css.css">
	<script src="/node_modules/jquery/dist/jquery.slim.min.js"></script>
	<script src="/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="/node_modules/jquery-ui/jquery-ui.min.js"></script>
	<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/js/test.js"></script>
	<script src="/js/basket.js"></script>
	<script src="/js/dropmenu.js"></script>
	<script src="/js/animation.js"></script>
	<script src="/js/ajax.js"></script>
	<script src="/js/insert.js"></script>
	<script src="/js/editblock.js"></script>
	<script>
		$(document).ready(function () {

			var require = false;
			var col =[];
			if(window.innerWidth < 642){

				navCollapse();

			}
			else if(window.innerWidth > 642){

				navExpand();
			}
			$(window).on('resize', function () {
				if(window.innerWidth < 642){

					navCollapse();
				}else if(window.innerWidth > 642){

					navExpand();
				}
			});



			function navCollapse() {

				if($('#dropUl')[0]){
					return;
				}else{
					var len = $('#maket-ul-collapse')[0].children;
					//var col =[];
					var ul = $('<ul />',{class:'newUl',id:'dropUl'});
					ul.css({'overflow':'hidden','display':'none'});


					$('#maket-dropmenu').css('display','flex');

					for(var i=3;i<len.length;i++){
						col.push(len[i]);

					}

					ul.append(col);
					$('#maket-dropmenu').append(ul);
					$('#maket-dropmenu').on('click',function () {
						if(!require) {
							console.log(require);
							$('#dropUl').show('blind',{},500);
							require = true;

						}else{
							console.log(require);
							$('#dropUl').hide('blind',{},500);
							require = false;

						}
						});

				}

			}
			function navExpand(){
				$('#maket-dropmenu').off('click');
				$('#maket-dropmenu').css('display','none');
				if($('#dropUl')[0]){
					$('#dropUl').remove();
				}

				$('#maket-ul-collapse').append(col);

			}



			$('.nav').on('click', 'a',function () {
					$('.nav a').toggleClass('active', false);
					$(this).toggleClass('active',true);
				}
			);



			$('.button').on('click', function () {
				var top = $(this).offset().top;

				event.stopPropagation();
				if($('.formbox_hidden').hasClass('formbox')){

					$('.formbox_hidden').toggleClass('formbox',false);
				}else {
					$('.formbox_hidden').toggleClass('formbox',true);
					$('.formbox').css({
						'top':top+45
					})
				}

			});
			$('.formbox_hidden').on('click',function(){
				event.stopPropagation();

				$('#login').on('input',function() {
					var str = $(this).val();
					var value = '[а-яёА-ЯЁ]';
					if(checkInput(str,value)!==true){
						$('#login').val('');
					}
				});
			});
			$(document).on('click',function(){
				$('.formbox_hidden').removeClass('formbox');

			});


			$('.nav').on('click', 'a',function () {
					$('.nav a').toggleClass('active', false);
					$(this).toggleClass('active',true);

				}
			);
			$('#staticBackdrop').on('click','.close, .btn-secondary',function () {
				$('.modal-body').empty();
			});

			function clearSelection() {
				if (window.getSelection) {
					window.getSelection().removeAllRanges();
				} else { // старый IE
					document.selection.empty();
				}
			}
			$('.price_range').on('mousemove',clearSelection);

			var myrangeSlide = {
				widthRange :  parseFloat($('.range').css('width')),
				option: [50,400],//диапазон выбора

				d : function(j){

					slide(j,this);
				}
			};



			myrangeSlide.d($('.range'));


			$('.aside_container nav')
				.css('overflow','hidden');
//moveBlock(Elem,visible(true or false),color[](active, disactive),time(duration))
			expandBlock('.category','.category_nav',false,{
				'0': '#ef5b70',
				'1': '#6f6e6e'
			},1);
			expandBlock('.brand','.brand_nav',false,{
				'0': '#ef5b70',
				'1': '#6f6e6e'
			},1);
			expandBlock('.designer','.designer_nav',false,{
				'0': '#ef5b70',
				'1': '#6f6e6e'
			},1);
			var drop = new DropMenu('.sort_settings_2');

			drop.render();

			$('.edit_button').on('click',function () {
				$('form[name=edit_block]').off('change','**');
				var this_ = this;
				$('#save-edit').off();

				editGoods(this);

				var files;
				var path = $(this).closest('.items-1');
				path = $(path).find('img').attr('src');

				$('.modal-body').on('change', function(){
					files = $(document.forms.edit_block[0].files);

					var insert = new Insert();
					insert.previewImage(event);

				});
				$('#save-edit').on('click',function () {

					if(files){
						if(files.length === 0){

							saveEdit(document.forms.edit_block,this_,path);
						}else{

							loadFile(files,this_,function(pathI){
								saveEdit(document.forms.edit_block,this_,pathI)
							})
						}
					}
				});

			});
			$(window).scroll(function () {
				if(pageYOffset > 300){
					$('#scroll-up').css({
						'bottom':'8px'
					})
				}else{
					$('#scroll-up').css({
						'bottom': '-100px'
					})
				}
			});
			$('#scroll-up').on('click',function (e) {
				e.preventDefault();
				$('html, body').animate({scrollTop:0});
			});

			$('#style input').on('click',function () {

				if($(this).parent().hasClass('press')===true){
					$(this).parent().toggleClass('press', false);
					$(this).val('');
					$(this).trigger('change');

				}else {
					$(this).parent().toggleClass('press', true);

					var name_lab = this.name;

					$(this).val(name_lab);
					$(this).trigger('change');
				}
			});

			$('.form-filter').on('change',function () {
				var style = readInput('style');
				var size = checkBox('size');
				var price = readInput('price');

				console.log(style,size,price);
				filter(style,size,price);
			});
		});


		</script>
</head>
<body>
<div class="header">
	<div class="box-flex">
	<!--<iframe src="../inwidget-master/index.php"></iframe>-->
	<div class="row w-100 m-0">
		<nav class="navbar navbar-expand-md navbar-light nav-custom" style="
    /* width: inherit; */
    height: inherit;
    width: 100%;
">
			<a href="/" class="logo">
				<img src="/img/Group%202.png" alt="logo"><div class="text">BRAN<span class="textlogo">D</span></div>
			</a>
			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse " id="navbarSupportedContent">
				<div class="container m-0 p-0">
					<div class="row w-100 m-0 p-0">
						<div class="box-flex_1 col-sm p-0 mb-1 mt-1">
							<div class="browse">
								<div class="browse-1">
									<div>Browse</div>
									<span class="point-1"></span>
								</div>
								<form action="http://maket2.ru:82" style="height: 3.8em;">
								<input type="text" name="search" placeholder="Search for item..." class="input_main">
								<button type="submit" name="search" value="" class="search"><img src="/img/search.png"></button></form>
							</div>
						</div>
						<div class="box-flex_2 col-sm mb-1 mt-1 p-0">
							<div class="basket">
								<span>В корзине <span class="count_goods"><?php if(!empty($basket['totalcount'])){ echo $basket['totalcount'];}else{echo 0;} ?></span> товаров</span>
								<span>На сумму: <span class="total"><?php if(!empty($basket['total'])){
									echo $basket['total'];}else{
										echo 0;
										} ?></span> руб.</span>

							</div>
							<p data-toggle="modal" data-target="#staticBackdrop"><i class="fa fa-shopping-cart" aria-hidden="true" onclick="showBasket()"></i></p>
							<div class="button">
								<div class="my-acc"><?php
									if(\components\Auth::getLogin()){echo \components\Auth::getLogin(); } else {echo 'My Account';}
									?></div>
								<div class="point"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</nav>
	</div>

	</div>
</div>
<div class="container con-h">
	<?php if(\components\Auth::check()): ?>
				<a class="logout" onclick="logOut()">Выйти</a>
			<?else:?>
		<div class="formbox_hidden">
			<div class="fon"></div>
			<form name="auth" class="auth">
				<input type="text" id="login" name="login" placeholder="Inter your login..." class="field_login">
				<input type="password" id="pass" name="pass" placeholder="Inter your password..." class="field_pass">
				<div class="field_submit_checkbox">
					<a name="submit" class="authbutton" onclick="Auth()"><span>Войти</span></a>
					<div>
						<label style="font-size:2.6em">Запомнить</label><input type="checkbox" name="remember" class="field_checkbox" style="margin-left: 0.5em;width: 1.6em;height: 1.6em;" id="remember">

					</div>
				</div>
				<input name="reguser" value="Зарегистрироваться" class="authbutton" onclick="regUser()">
			</form>
		<?php endif; ?>
	</div>
	<div class="nav">
		<ul id="maket-ul-collapse" class="nav-ul">
			<li><a href="http://maket2.ru:82/" class="nav_a active">Home</a></li>
			<li><a href="#" class="nav_a">Man</a></li>
			<li><a href="#" class="nav_a">Women</a></li>
			<li><a href="#" class="nav_a">Kids</a></li>
			<li><a href="#" class="nav_a">Accoseriese</a></li>
			<li><a href="#" class="nav_a">Featured</a></li>
			<li><a href="#" class="nav_a">Hot Deals</a></li>
		</ul>
		<div id="maket-dropmenu" class="maket-dropmenu">
			<p style="margin:0">More Categories</p>
		</div>
	</div>
</div>
<a href="#header" id="scroll-up" class="scroll-up"><i class="fa fa-angle-up"></i></a>
<?php  echo $content; ?>
</body>
</html>
<!--<script>

	$('.total').on('text:changed',function(){
		console.log('change');
	})
</script>