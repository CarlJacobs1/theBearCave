function newAjaxRequest(){
	var $ajax_request;
	try{
		$ajax_request = new XMLHttpRequest();
		return $ajax_request;
	}catch (e){
		try{
			$ajax_request = new ActiveXObject("Msxml2.XMLHTTP");
			return $ajax_request;
		}catch (e){
			try{
				ajax_request = new ActiveXObject("Microsoft.XMLHTTP");
				return $ajax_request;
			} catch(e){
				alert("Error on AJAX request.");
				return false;
			}
		} 
	}

}

function sendAjaxRequest(
	  $ajax_request_object
	, $request_method
	, $request_path
	, $ajax_query_string
	){

	$ajax_request_object.open($request_method, $request_path, true);
	$ajax_request_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	$ajax_request_object.send($ajax_query_string);

}