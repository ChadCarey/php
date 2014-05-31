
function validate() {
    document.getElementById('temp').innerHTML = "<p>function called</p>"

    var name = document.forms['form']['name'].value;
    if( !(/[a-zA-Z]+/).test(name))
	return false;
    var cost = document.forms['form']['cost'].value;
    if( !(/[0-9]+.*/).test(cost))
	return false;
    var distance = document.forms['form']['distance'].value;
    if( !(/[0-9]+.*/).test(distance))
	return false;
    var gas = document.forms['form']['gas'].value;
    if( !(/[0-9]+.*/).test(gas))
	return false;
    var internet = document.forms['form']['internet'].value;
    if( !(/[0-9]+.*/).test(internet))
	return false;
    var city = document.forms['form']['city'].value;
    if( !(/[0-9]+.*/).test(city))
	return false;
    var electric = document.forms['form']['electric'].value;
    if( !(/[0-9]+.*/).test(electric))
	return false;

   document.getElementById('temp').innerHTML = "<p>function function finished</p>"


    return true;
}