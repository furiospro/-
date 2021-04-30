<div class="main">
	<img src="/img/Layer%2024.png">
	<div class="main-logo container">
		<!--<span class="slash"></span>-->
		<span class="maket_ml-1">THE BRAND</span><br>
		<span class="maket_ml-2">OF LUXERIOUS </span>
		<span class="maket_ml-3">FASHION</span>
	</div>
</div>
<div class="viewlist">
	<div class="con1">
		<div class="con1-1">
			<img src="/img/Layer 30.png">
			<div class="img-1 viewlist_img_top"><span class="sp1">HOT DEAL<br><span class="sp2">FOR MEN</span></span></div>
		</div>
		<div class="con1-2">
			<img src="/img/Layer 37.png">
			<div class="img-2 viewlist_img_top">
				<span class="sp1">LUXIROUS & TRENDY<br>
					<span class="sp2">ACCESORIES</span>
				</span>
			</div>
		</div>
	</div>
	<div class="con2">
		<div class="con2-1">
			<img src="/img/Layer 32.png">
			<div class="img-3 viewlist_img_top">
				<span class="sp1">30% OFFER<br>
					<span class="sp2">WOMEN</span>
				</span>
			</div>
		</div>
		<div class="con2-2">
			<img src="/img/Layer 31.png">
			<div class="img-4 viewlist_img_top">
				<span class="sp1">NEW ARRIVALS<br>
					<span class="sp2">FOR KIDS</span>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="p1">
	<p class="p1-1">Featured Items</p>
	<p class="p1-2">Shop for items based on what we featured in this week</p>
</div>
<div class="items">
	<div class="items block">
		<?php foreach($result as $item):?>
			<div class="items-1" id_good="<?php echo $item['id_good'];?>">
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
<div class="all-product"><a href="product">Browse All Product<img src="../img/arrow.png"></a></div>
<div class="clearboth"></div>
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
<?include 'footer.php';?>
