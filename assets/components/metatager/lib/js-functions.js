/* Функции поиска по сайту
-----------------------------------------------------------------------------*/
var siteSearchState={};

function PrepareToCloseSearchResults(){
$('body').click(function() {$("#search_results").fadeOut(400)});
// Останавливаем распространение события при клике в результатах поиска
$("#search_results").click(function(event){
    event.stopPropagation();
 });
// Останавливаем распространение события при клике в форме поиска
$(siteSearchState.fieldSelector).click(function(event){
    event.stopPropagation();
 });
}

/* Поиск по содержимому на стороне сервера
-----------------------------------------------------------------------------*/
function fnShowSearchResults(obj, objName){
    var result = "";
    for (var i in obj){ // обращение к свойствам объекта по индексу
	
        result += '<a href="' + obj[i].link + '" title="' + obj[i].introtext + '">' + obj[i].pagetitle + '</a><br class="clear" />\n';
	}
	if(result == '') result = '<div class="center"><strong>Ничего не найдено</strong></div>';
    return result;
}

function Success(data){ // Обработка результата запроса
	//$("#search_results").html("");
	//$("#search_results").append( jsondata.pagetitle + ",<br />\n");
	// alert(data.responseText); // Debug - посмотреть результат
	//var arr = $.parseJSON(data.responseText);
	var arr = JSON.parse(data.responseText);
	$("#search_results").html(fnShowSearchResults(arr, "arr"));
	
	/*
	$.each(arr, function(i, val) {
		alert("i = " +i+ " = " + val);
	});
	*/
	
	$("#search_results").slideDown(400, PrepareToCloseSearchResults);
}

function Search(){
	var request='r='+$(siteSearchState.fieldSelector).val() + '&limit=10';
	$.ajax({url:"http://effettoshop.ru/catalog/json-catalog.html", data:request, type:"GET",
		complete: Success,
		//error: function() {alert("Internal error occured!");},
		dataType: "json"});
return false;
}

function activateAjaxSiteSearch(fieldSelector){
	siteSearchState.fieldSelector=fieldSelector;
	$(siteSearchState.fieldSelector).submit(Search);
	$(siteSearchState.fieldSelector).keyup(function(e){Search(); return true; });
	// Здесь необходимо добавить обработку событий mouseenter, mouseleave: http://xhtml.co.il/ru/jQuery/mouseleave
	//$(fieldSelector).focusout(function(){  $("#search_results").slideUp(400); }); 
	$("body").append('<div id="search_results"></div>');
	$("#search_results").hide();
}


/* Поиск по полностью загруженному каталогу
-----------------------------------------------------------------------------*/
function fnFilterLocalData(obj, request){
    var result = "";
	var j=0;
    for (var i in obj){ // обращение к свойствам объекта по индексу
		// Ограничиваем результаты поиска 10 строками
		if(j>9) continue;
		var introtext=obj[i].introtext;
		var pagetitle=obj[i].pagetitle;
		
		if(request.length>1){ // Выделение искомой фразы в тексте
			var RE = new RegExp('('+request+')', 'ig');
			pagetitle = pagetitle.replace(RE, "<b>$1</b>");
			introtext = introtext.replace(RE, "<b>$1</b>");
		}
		
		// Поиск подстроки
		var found=false;
		var str = obj[i].pagetitle; // Поиск по содержимому pagetitle
		if(str.toLowerCase().indexOf(request.toLowerCase()) + 1) found=true;
		var str = obj[i].longtitle; // Поиск по содержимому longtitle
		if(str.toLowerCase().indexOf(request.toLowerCase()) + 1) found=true;
		var str = obj[i].introtext; // Поиск по содержимому introtext
		if(str.toLowerCase().indexOf(request.toLowerCase()) + 1) found=true;
		
		if(found) { // поиск вхождения подстроки, все символы сведены к нижнему регистру
			
		
			// Формирование строки в поле поиска
			result += '<div class="SearchImageDiv">';
			if(obj[i].image>'') result += '<a href="' + obj[i].link + '" title="' + obj[i].introtext + '"><img src="'+obj[i].image+'" alt=" " style="height:50px;" /></a>';
			result += '</div>';
			result += '<a href="' + obj[i].link + '" title="' + obj[i].introtext + '">' + pagetitle + '</a>';
			if(introtext>'')result += '<p>'+introtext+'</p>';
			else result += '<p>'+obj[i].description+'</p>';
			result += '<br class="clear" />\n';
			j++;
		}
		else continue;
		
	}
	if(result == '') result = '<div class="center"><strong>Ничего не найдено</strong></div>';
    return result;
}

function SearchInLocalData(){
	var request = $(siteSearchState.fieldSelector).val();
	$("#search_results").html(fnFilterLocalData(siteSearchState.Catalog, request));
	
	$("#search_results").fadeIn(400, PrepareToCloseSearchResults);
}

function SaveCatalogObject(data){
	var objCatalog = JSON.parse(data.responseText);
	//$("#search_results").html(fnShowSearchResults(objCatalog, "objCatalog"));
	siteSearchState.Catalog=objCatalog;
}

function activateFullSiteSearch(fieldSelector){
	// Записываем селектор поля поиска в глобальный объект
	siteSearchState.fieldSelector=fieldSelector;
	
	// При клике на поле поиска загружаем весь каталог
	$(siteSearchState.fieldSelector).one('focus', function(){
		var request='includeContent=1';
		$.ajax({url:"http://effettoshop.ru/catalog/json-catalog.html", type:"GET", //, data:request
			complete: SaveCatalogObject,
			//error: function() {alert("Internal error occured!");},
			dataType: "json"
		});
		return false;
	});
	
	$(siteSearchState.fieldSelector).keyup(function(e){SearchInLocalData(); return true; });
	
	// Настраиваем div для вывода результатов поиска
	$("body").append('<div id="search_results"></div>');
	$("#search_results").hide();
}

