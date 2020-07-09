/*sideabr*/
			$(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });

            /*dropdown*/
            $(".dropdown-menu li a").click(function(){
              var selText = $(this).text();
              $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
            });

            $("#btnSearch").click(function(){
                alert($('.btn-select').text()+", "+$('.btn-select2').text());
            });

            /*table*/
            $(document).ready(function() {
                $('#example').DataTable();
            } );
			
			/*image_upload*/
            var $imageupload = $('.imageupload');
            $imageupload.imageupload();
			
			/*jquery calender*/
			  $(document).ready(function() {
			   var calendar = $('#calendar').fullCalendar({
				editable:true,
				header:{
				 left:'prev,next today',
				 center:'title',
				 right:'month,agendaWeek,agendaDay'
				},
				events: 'load.php',
				selectable:true,
				selectHelper:true,
				select: function(start, end, allDay)
				{
				 var title = prompt("Enter Event Title");
				 if(title)
				 {
				  var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
				  var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
				  $.ajax({
				   url:"insert.php",
				   type:"POST",
				   data:{title:title, start:start, end:end},
				   success:function()
				   {
					calendar.fullCalendar('refetchEvents');
				   }
				  })
				 }
				},
				editable:true,
				eventResize:function(event)
				{
				 var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
				 var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
				 var title = event.title;
				 var id = event.id;
				 $.ajax({
				  url:"update.php",
				  type:"POST",
				  data:{title:title, start:start, end:end, id:id},
				  success:function(){
				   calendar.fullCalendar('refetchEvents');
				  }
				 })
				},

				eventDrop:function(event)
				{
				 var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
				 var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
				 var title = event.title;
				 var id = event.id;
				 $.ajax({
				  url:"update.php",
				  type:"POST",
				  data:{title:title, start:start, end:end, id:id},
				  success:function()
				  {
				   calendar.fullCalendar('refetchEvents');
				  }
				 });
				},

				eventClick:function(event)
				{
				 if(confirm("Are you sure you want to remove it?"))
				 {
				  var id = event.id;
				  $.ajax({
				   url:"delete.php",
				   type:"POST",
				   data:{id:id},
				   success:function()
				   {
					calendar.fullCalendar('refetchEvents');
				   }
				  })
				 }
				},

			   });
			  });
			  