
	$('#chart').hide();

	function usersData(year='')
	{
		$.ajax({
			type:"POST",
			url:"{{route('admin.users-chart')}}",
			data:{year:year},
			success: function(res) {
				console.log(res);

				console.log(res.spline);
				$('#chart').show();

				//spline chart starts
				var chartSpline = new CanvasJS.Chart("splineContainer",
			    {
			    
			      title:{
			      text: "Users count per day of "+res.month+" "+res.year  
			      },
			       data: [
			      {        
			        type: "spline",
			        
			        dataPoints: res.spline
			        
			      }       
			        
			      ]
			    });
			    chartSpline.render();
				
				//spline chart ends

				//bar chart starts
				var chartBar = new CanvasJS.Chart("barContainer", {
					title:{
						text: "Users count per month of "+res.year             
					},
					data: [              
					{
						// Change type to "doughnut", "line", "splineArea", etc.
						type: "column",
						dataPoints: res.bar
					}
					]
				});
				chartBar.render();
				//bar chart ends

				

			}
		});
	}



	$(document).ready(function(){
	 		$("#year").on('change', function(){
	 			//alert('clicked');
	 			var year=$(this).val();
	 			//alert(year);
	 			usersData(year);

	 		})

	 		
	 	});


	

	
	 	

	 
