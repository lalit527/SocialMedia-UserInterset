// JavaScript Document
$(document).ready(function(e) {
	 $("#getIn").click(function() {
		 
	   $("#signUp").show();
           $("#getExisting").show();
           $("#menu").hide();
           $("#getIn").hide();
           
	 $("#getExisting").click(function(){
            $("#menu").show();
	     $("#getExisting").hide();
	   e.preventDefault();
	  }); 
	});
	});
$(document).ready(function(e) {
	 $("#checkOut").click(function() {
		 
		 $("#divCheckOut").show();
	 $("#closeLogOut").click(function(){
	   $("#divCheckOut").hide();
	   e.preventDefault();
	  }); 
	});
	});
