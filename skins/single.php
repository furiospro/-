<div class="main_single">
	<div class="top_block">
		<p class="top_block_p1">WOMEN COLLECTION</p>
		<div class="top_block_p1_border">
			<div class="top_block_p1_border_gray"></div>
			<div class="top_block_p1_border_red"></div>
			<div class="top_block_p1_border_gray"></div>
		</div>
		<p class="top_block_p2">Moschino Cheap And Chic</p>
		<p class="top_block_p3">Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals. </p>
		<p class="top_block_p4">
			<span class="material" style="float:left">MATERIAL:<span class="cotton">COTTON</span></span>
			<span class="material" style="float:right">DESIGNER:<span class="cotton">BINBURHAN</span></span>
		</p>
		<p class=top_block_price><?php echo $result['price'];?>$</p>
		<div class="choose">
			<form name="add_basket" id-good="<?php echo $result['id_good'] ?>">
			<div class="form_container">
				<div class="color">
				<p>CHOOSE COLOR</p>
				<div><span></span>
				<select name="color" class="choose_select">

					<option>
						Red
					</option>

					<option>
						blue
					</option>

				</select>
				</div>

			</div>
			<div class="size">
				<p>CHOOSE SIZE</p>
				<div>
					<select name="size" class="choose_select">
						<?php foreach($result['size'] as $item):
							foreach($item as $value): ?>
						<option>
							<?php  echo $value; ?>
						</option>
						<?php endforeach;
						endforeach; ?>
					</select>
				</div>
			</div>
			<div class="quantity">
				<p>QUANTITY</p>
				<input class="quantity_input" type="text" name="quantity" placeholder="write quantity">
			</div>
				</div>
			<div class="add_to_cart" onclick="addGoods(this)">
				<img src="/img/Basket_red.png"><span>Add to Cart</span>
			</div >
			</form>
		</div>
	</div>
	<div class="block1">
		<p class="new_arrivals">New Arrivals </p>
		<p class="block1_p">Home / Men /
			<span>New Arrivals</span>
		</p>
	</div>
	<div class="block2" id-good="<?php echo $result['id_good']?>">
		<img src="<?php echo $result['img']?>">
	</div>
	<div class="block3">

		<?php foreach($goods as $item):?>
			<div class="items-1 items-1_products" id_good="<?php echo $item['id_good'];?>">
				<div class="shadow">
					<div class="sh-cont">
						<?php if(components\Auth::isAdmin()): ?><a href="" class="edit_button cart-link" id="<?php echo $item['id_good']; ?>" data-toggle="modal" data-target="#staticBackdrop"><span class=" add-to-cart"> Редактировать</span></a>
						<?php else: ?>
						<a href="/product/single?id=<?php echo $item['id_good']?>" target="_blank" class="cart-link"><img src="../img/Forma_1.png"><span class="add-to-cart"> Add to Cart</span></a><?php endif; ?>
					</div>
				</div>
				<img src="<?php echo $item['img'];?>">
				<p class="description"><?php echo $item['description'];?></p>
				<p class="price">$<?php echo $item['price'];?></p>
			</div>
		<?php endforeach;?>

	</div>
</div>
<div class="clearboth-baner"></div>

<?include 'footer.php';?>

<!--<script>
	$('.add_to_cart').on('click', function () {
		addGoods('.block2');
	});

</script>

<div class="items-1">
			<div class="shadow single">
				<div class="sh-cont">
					<a href="#" class="cart-link"><img src="../img/Forma_1.png"><span class="add-to-cart"> Add to Cart</span></a>
				</div>
			</div>
			<figure>
			<div class="single_figure_image_width">
				<img src="/img/Layer_44.png"></div>
				<figcaption class="description">BLAZE LEGGINGS</figcaption>
				<figcaption class="price">$52.00</figcaption>
			</figure>
			</div>
			<div class="items-1">
				<div class="shadow single">
					<div class="sh-cont">
						<a href="#" class="cart-link"><img src="../img/Forma_1.png"><span class="add-to-cart"> Add to Cart</span></a>
					</div>
				</div>
				<figure>
					<div class="single_figure_image_width">
						<img src="/img/Layer_45.png"></div>
					<figcaption class="description">BLAZE LEGGINGS</figcaption>
					<figcaption class="price">$52.00</figcaption>
				</figure>
			</div>
			<div class="items-1">
				<div class="shadow single">
					<div class="sh-cont">
						<a href="#" class="cart-link"><img src="../img/Forma_1.png"><span class="add-to-cart"> Add to Cart</span></a>
					</div>
				</div>
				<figure>
					<div class="single_figure_image_width">
						<img src="/img/Layer_46.png"></div>
					<figcaption class="description">BLAZE LEGGINGS</figcaption>
					<figcaption class="price">$52.00</figcaption>
				</figure>
			</div>
			<div class="goods">
				<div class="shadow single">
					<div class="sh-cont">
						<a href="#" class="cart-link"><img src="../img/Forma_1.png"><span class="add-to-cart"> Add to Cart</span></a>
					</div>
				</div>
				<figure>
					<div class="single_figure_image_width">
						<img src="/img/Layer_47.jpg" style="width:inherit;"></div>
					<figcaption class="description">BLAZE LEGGINGS</figcaption>
					<figcaption class="price">$52.00</figcaption>
				</figure>
			</div>



-->
