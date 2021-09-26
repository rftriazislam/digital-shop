




var request = new XMLHttpRequest()

request.open('GET', 'https://openexchangerates.org/api/latest.json?app_id=1d198fa2354940eca5d4bb7a85983404', true)
request.onload = function () {
    // Begin accessing JSON data here
    var data = JSON.parse(this.response)

    if (request.status >= 200 && request.status < 400) {

        var dta = data.rates;
        for (var i = 0; i < dta.length; i++) {
            console.log(i);
        }


    } else {
        console.log('error')
    }
}

request.send();
$('#country').on('change', function () {



});