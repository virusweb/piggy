$(document).ready(function(){
	$("a[title ~= 'BotDetect']").removeAttr("style");
	$("a[title ~= 'BotDetect']").removeAttr("href");
	$("a[title ~= 'BotDetect']").css('visibility', 'hidden');
});