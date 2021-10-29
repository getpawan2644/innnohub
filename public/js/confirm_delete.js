/*-----------Confirm Delete-----------*/

$(document).ready( function() {
	
	$(document).on('click','.confirmDelete',function(e){
		e.preventDefault();
		var href = $(this).attr('data-action');
		var text = $(this).attr('data-message');
		if(text==undefined){
			var text = "You want to delete this record.";
		}
		$.confirm({
			title: "Are you sure?",
			content: text,
			type: 'red',
			icon : 'fa fa-exclamation-circle',
			buttons: {   
				ok: {
					text: "Yes, delete it!",
					btnClass: 'btn-primary',
					//keys: ['enter'],
					action: function(){
						window.location.href = href;
						//console.log('the user clicked confirm');
					}
				},
				cancel: function(){
					//console.log('the user clicked cancel');
				}
			}
		});
	});
});