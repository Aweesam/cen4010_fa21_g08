'use strict'; 

//Weather API KEY
const WEATHER_API_KEY = "9be281727026afb148d17e2ddab9bf30";

//The weather widget is being used instead of this code for OpenWeather API
var doweather = function() {
    clean_buttons();
    document.getElementById('weather').classList.add("selected");
    var workspace = document.getElementById("content");
    workspace.innerHTML = "";

    var btn = document.createElement("button");
    var winfo = document.createElement("div")
    var txtbox = document.createElement("input")
    txtbox.setAttribute("id","weatherq");
    txtbox.setAttribute("placeholder","Enter a city or zip...")
    winfo.setAttribute("id","weatherdata");
    btn.innerHTML = "Go!";

    btn.onclick = getWeatherInfo;

    workspace.appendChild(txtbox);
    workspace.appendChild(btn);
    workspace.appendChild(winfo);


    

}


//Get weather from Yahoo
function getWeatherInfo(event) {

    //find the element
    var val = document.getElementById("weatherq").value;
    if (val === "") { //Check for empty string, if empty provide error message
        var e = $('#p');
        e.html("Can't search for empty string");
        return;

    }
    if (isNaN(val)) { //If value is not a number, call weather API by CITY
        console.log("CITY Detected");
        var url = "https://api.openweathermap.org/data/2.5/weather?q=" + val + "&units=imperial&appid=" + WEATHER_API_KEY;
        fetchRequest(url, onWeatherSuccess, onWeatherFail);

    }
    else { //ELSE CALL BY ZIP CODE
        console.log("ZIP Detected");
        var url = "https://api.openweathermap.org/data/2.5/weather?zip=" + "34982" + "&units=imperial&appid=" + WEATHER_API_KEY;
        fetchRequest(url, onWeatherSuccess, onWeatherFail);
    }

}

function fetchRequest(url, onSuccess, onFailure) {
    fetch(url)
        .then(function (response) {
            console.log(response);
            response.json()
                .then(function (value) {
                    console.log(value);
                    onSuccess(value);
                })
                .catch(function (error) {
                    console.log("error: ", error);
                    alert("Something went wrong. Google how to open the DevTools console");
                    onFailure(error);
                })
        })
        .catch(function (error) {
            console.log("error: ", error);
            alert("Something went wrong. Google how to open the DevTools console");
            onFailure(error);
        });
}

function onWeatherSuccess(data) {
   
    
    createTable();
    
    //var winds = document.getElementById("wind");
    wind.textContent += data.wind.speed + " meters/sec";
    vis.textContent += data.visibility + " meters";
    cloud.textContent += data.clouds.all + " % Cloudy";
    humidity.textContent += data.main.humidity + " % Humid";
    
     //Convert Unix sunrise/sunset time to regular time
     var unix_set = data.sys.sunset;
     var unix_rise = data.sys.sunrise;
     var set_date = new Date(unix_set * 1000);
     var rise_date = new Date(unix_rise * 1000);
     var set_hours = set_date.getHours();
     var rise_hours = rise_date.getHours();
     var set_minutes = "0" + set_date.getMinutes();
     var rise_minutes = "0" + rise_date.getMinutes();
     var formatted_set = set_hours + ':' + set_minutes.substr(-2);
     var formatted_rise = rise_hours + ':' + rise_minutes.substr(-2);

     sunrise.textContent += formatted_rise;
     sunset.textContent += formatted_set;
     geo.textContent += "Lon:" + data.coord.lon + "  Lat:" + data.coord.lat;
     temper.textContent += data.main.temp + '°F';
     feelstemper.textContent += data.main.feels_like + '°F';
     pressure.textContent += data.main.pressure + ' hPa';

     
  
    
    var workspace = document.getElementById("content");
    var h1 = document.createElement('h1');
    var text = document.createTextNode("Weather for " + data.name);
    h1.appendChild(text);
    workspace.append(h1);

    var h1 = document.createElement('h1');
    var text = document.createTextNode(data.weather[0].main);
    h1.appendChild(text);
    workspace.append(h1);

    


    
}

function onWeatherFail(status) {
    alert("Failed to get weather on Code " + toString(status));
}

function createTable()
{
    var workspace = document.getElementById("content");
    workspace.innerHTML = `
    <div class="col-lg-12 col-lg-offset-12 cent" id="details">
                                <table class="table table-sm" id="detailss">
                                    <tbody>
                                        <tr class="table-primary">
                                            <td>Wind Speed</td>
                                            <td id="wind"></td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>Visibility</td>
                                            <td id="vis"></td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Cloudiness</td>
                                            <td id="cloud"></td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>Humidity</td>
                                            <td id="humidity"></td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Sunrise</td>
                                            <td id="sunrise"></td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>Sunset</td>
                                            <td id="sunset"></td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>Geo Coords</td>
                                            <td id="geo"></td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>Temperature</td>
                                            <td id="temper"></td>
                                        </tr>
                                        <tr class="table-primary">
                                            <td>"Feels like" Temp</td>
                                            <td id="feelstemper"></td>
                                        </tr>
                                        <tr class="table-danger">
                                            <td>Pressure</td>
                                            <td id="pressure"></td>
                                        </tr>
                                    </tbody>
                                </table>
</div>
    `;
}