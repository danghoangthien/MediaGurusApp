// JavaScript Document
/*

Server :
	ajax intergrated load :
		1/ load navigation
			params:
				$_POST["type"]="no_of_page" 
				$_POST["cur_page"]= int
			return : 
				pre define HTML ul li navigation structure
		2/ load page
			params:
				$_POST["type"]="page" 
				$_POST["page"]= int
			return : 
				JSON datatype	
	dependency :
		1/any database to JSON format
	to do : 
		1/ considering develop XML version
Client :
	1/ jquery-tmpl to bind json data to html
*/
//(function($) {
    $.fn.pagebind = function(options) {
  		// Our plugin implementation code goes here.
		var defaults = {
			data		: "",
    		url			: "",
			template	: "",
			navigation	: "",
			onBindPage	: function(){}
  		};
		//var opts = $.extend(defaults, options);
		if ( options ) {var options=$.extend( defaults, options );  	}
		return this.each(function() {
			var o = options;	
				
            var obj = $(this);  
			$.ajaxSetup({
  				url: o.url,
				type:'POST',
				dataType:'json'
			});
			function no_of_page(cur_page){
				var data=	$.extend( {type:"no_of_page",cur_page:cur_page}, o.data );
				$.ajax({
					data:data,
					dataType:'html',					
					success:function(html){
						
						bind_navigation(html);
						
						bind_page(cur_page);
						
					}
				})
			} 
			function bind_page(page){
				var data=	$.extend( {type:"page",page:page}, o.data );
				$.ajax({
					data	:data,
					dataType:'json',
					success	:function(json){
						//alert("aa2a")
						$(obj).html($( o.template ).tmpl( json.rows ));
					var rel=$(obj).html();
					var rel2=rel.replace(/&lt;/g,"<").replace(/&gt;/g,">");
					$(obj).html(rel2);
						
						o.onBindPage.call();
						//$.fn.ready();
						//effect, callback... 
					},
					complete:function(jqXHR,textStatus){

							//alert("dg");
							//setTimeout(function(){o.onBindPage},3000);
			
						
					}
				});
			}
			function bind_navigation(html){
				$(o.navigation).html(html);
				$(o.navigation+" .active").click(function(){
					no_of_page($(this).attr("p"));
				})
				return;
			} 
			no_of_page(1);

			
			
			//obj.append("<option>go</option>");  
	    });
	};
	//})(jQuery);