function size(){
 
}


$(document).ready(function(){
 //size();
 
 var wHeight = $(window).height();
 $('.wheight').css({'height': wHeight - 215 });
 
})
$(window).resize(function(){
 var wHeight = $(window).height();
 console.log($(window).height());
 console.log($(window).height());
 $('.wheight').css({'height': wHeight - 215 });
});

$(window).load(function(){
 var wHeight = $(window).height();
 $('.wheight').css({'height': wHeight - 215 });
});