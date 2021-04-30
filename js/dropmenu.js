function DropMenu(elem) {
	this.elem = elem;
	this.value ='';
	this.currentMenu = '';
}
DropMenu.prototype.render = function () {

	var this_ = this;

	$(this_.elem).on('click', function () {
		this_.currentMenu = $(this);
		$(this).find('.dropmenu').toggleClass('show');
		return false;

	});

	$(this_.elem)
		.find('.dropmenu')
		.on('click', 'li', function () {
			this_.value = $(this).text();
		$(this_.currentMenu).find('p').text(this_.value);
		})

};