<div class="block1">

	<div class="block1_content">
		<p class="new_arrivals">New Arrivals </p>
		<p class="block1_p">Home / Men /
			<span>New Arrivals</span>
		</p>

	</div>
</div>
<div class="product_main">
	<aside class="aside_container">
		<div class="category">
			<p>Category</p>
			<div class="category_triangle"></div>
		</div>
		<nav class="category_nav">
			<a href="#">Accessories</a>
			<a href="#">Bags</a>
			<a href="#">Denim</a>
			<a href="#">Hoodies & Sweatshirts</a>
			<a href="#">Jackets & Coats</a>
			<a href="#">Pants</a>
			<a href="#">Polos</a>
			<a href="#">Shirts</a>
			<a href="#">Shoes</a>
			<a href="#">Shorts</a>
			<a href="#">Sweaters & Knits</a>
			<a href="#">T-Shirts</a>
			<a href="#">Tanks</a>
		</nav>
		<div class="brand">
			<p>BRAND</p>
			<div class="category_triangle"></div>
		</div>
		<nav class="brand_nav">
			<a href="#">Accessories</a>
			<a href="#">Bags</a>
			<a href="#">Denim</a>
			<a href="#">Hoodies & Sweatshirts</a>
			<a href="#">Jackets & Coats</a>
			<a href="#">Pants</a>
			<a href="#">Polos</a>
			<a href="#">Shirts</a>
			<a href="#">Shoes</a>
			<a href="#">Shorts</a>
			<a href="#">Sweaters & Knits</a>
			<a href="#">T-Shirts</a>
			<a href="#">Tanks</a>
		</nav>
		<div class="designer">
			<p>DESIGNER</p>
			<div class="category_triangle"></div>
		</div>
		<nav class="designer_nav">
			<a href="#">Accessories</a>
			<a href="#">Bags</a>
			<a href="#">Denim</a>
			<a href="#">Hoodies & Sweatshirts</a>
			<a href="#">Jackets & Coats</a>
			<a href="#">Pants</a>
			<a href="#">Polos</a>
			<a href="#">Shirts</a>
			<a href="#">Shoes</a>
			<a href="#">Shorts</a>
			<a href="#">Sweaters & Knits</a>
			<a href="#">T-Shirts</a>
			<a href="#">Tanks</a>
		</nav>
	</aside>

	<div>

		<div class="form_product">
			<form name="filter" class="form-filter">
				<div id="style" class="container form_product_1">
					<p>Trending now</p>

						<div class="row form_product_1_span_position">
						<?php $style = $arrResult['style'];
							foreach($style as $st):	?>
								<label class="col-4 form_product_1_span form_product_1_label"><?php echo ucfirst($st['name']); ?><input name="<?php echo $st['name'];?>" value="" style="display:none"></label>

						<?php endforeach;unset($st); ?>
							<?php $style = $arrResult['style'];
							foreach($style as $st):	?>
								<label class="col-4 form_product_1_span form_product_1_label"><?php echo ucfirst($st['name']); ?><input name="<?php echo $st['name'];?>" value="" style="display:none"></label>

							<?php endforeach; ?>
						</div>
				</div>
				<div id="size" class="container input_checkbox_position">
					<p>SIZE</p>
					<div class="row" style="margin-bottom:13px; width:inherit;">
						<?php $size = $arrResult['size']; foreach($size as $sz): ?>
						<div class="col-3" style="padding:unset;">
							<label><input type="checkbox" name="<?php echo $sz['name']; ?>" value=""><?php echo $sz['name'];?></label>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div id="price" class="price_range">
					<P>PRICE</P>
					<div id="mySlider" class="range">

					</div>
					<div class="range-value">
						<label><input type="text" id="count_1" name="minPrice" readonly style="border:0; color:#f6931f; font-weight:bold;"></label>
						<label><input type="text" id="count_2" name="maxPrice" readonly style="border:0; color:#f6931f; font-weight:bold;"></label>
					</div>
				</div>

			</form>
			<div class="sort_settings">
				<div class="sort_settings_1">
					<p>Sort By</p>
				</div>
				<div class="sort_settings_2">
					<p>Name</p>
					<div class="sort_settings_pointer"></div>
					<ul class="dropmenu">
						<li>Name 1</li>
						<li>Name 2</li>
						<li>Name 3</li>
					</ul>
				</div>
				<div class="sort_settings_1">
					<p>Show</p>
				</div>
				<div class="sort_settings_2" style="width:66px;">
					<p>09</p>
					<div class="sort_settings_pointer"></div>
					<ul class="dropmenu">
						<li>06</li>
						<li>09</li>
						<li>12</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="items_products">
			<?php $goods = $arrResult['goods'];
			foreach($goods as $item):?>

			<div class="items-1_products" id_good="<?php echo $item['id_good'];?>">
			<div class="shadow">
				<div class="sh-cont">
					<?php if(components\Auth::isAdmin()): ?><a href="" class="edit_button cart-link" id="<?php echo $item['id_good']; ?>" data-toggle="modal" data-target="#staticBackdrop"><span class=" add-to-cart"> Редактировать</span></a>
					<?php else: ?>
					<a href="/product/single?id=<?php echo $item['id_good']?>" target="_blank" class="cart-link"><img src="../img/Forma_1.png"><span class="add-to-cart"> Add to Cart</span></a><?php endif; ?>
				</div>
			</div>
			<img src="<?php echo $item['img']?>">
			<p class="description"><?php echo $item['description']?></p>
			<p class="price"><?php echo $item['price']?>$</p>
		</div>
		<?php endforeach;?>
			</div>

		</div>

	</div>
</div>
<div class="paginator">
	<nav>
		<a href="#" class="pag_nav">&#60</a>
		<a href="#" class="pag_nav pag_active">1</a>
		<a href="#" class="pag_nav">2</a>
		<a href="#" class="pag_nav">3</a>
		<a href="#" class="pag_nav">4</a>
		<a href="#" class="pag_nav">5</a>
		<a href="#" class="pag_nav">6</a>
		<span>...</span>
		<a href="#" class="pag_nav">20</a>
		<a href="#" class="pag_nav pag_active" style="margin-right:0">></a>
	</nav>
</div>
<div class="baner_cont">
	<div class="baner-position">
		<div class="baner">
			<div class="baner-text">
				<span class="baner-text-1">30%</span><span class="baner-text-2">OFFER<br></span><span class="baner-text-3">FOR WOMEN</span>
			</div>
			<img src="/img/Layer 38.png">
			<img src="../img/Layer%2039.png" style="
    position: absolute;
    z-index: 3;
    left: 0;
">
		</div>
		<div class="aside-baner">
			<div class="baner-1">
				<div class="png-1">
					<img src="../img/Forma%201.png">
				</div>
				<div class="baner-p">
					<p class="baner-p-1">Free Delivery</p>
					<p class="baner-p-2">Worldwide delivery on all. Authorit tively morph next-generation innovation with extensive models.</p>
				</div>
			</div>
			<div class="baner-1">
				<div class="png-1">
					<img src="../img/Forma%202.png">
				</div>
				<div class="baner-p">
					<p class="baner-p-1">Sales & discounts</p>
					<p class="baner-p-2">Worldwide delivery on all. Authorit tively morph next-generation innovation with extensive models.</p>
				</div>
			</div>
			<div class="baner-1">
				<div class="png-1">
					<img src="../img/Forma%203.png">
				</div>
				<div class="baner-p">
					<p class="baner-p-1">Quality assurance</p>
					<p class="baner-p-2">Worldwide delivery on all. Authorit tively morph next-generation innovation with extensive models.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clearboth-baner"></div>
<?php  include 'footer.php'; ?>