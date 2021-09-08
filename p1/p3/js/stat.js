
//Perform statistical analysis
function calculate() {
    
    var a = document.getElementById('firstNumber').value;

    var b = document.getElementById('secondNumber').value;

    var c = document.getElementById('thirdNumber').value;
    
    //make sure only numerical values were given
    if ( isNaN(a) || isNaN(b) || isNaN(c) )
        {
            alert("Please enter numerical values only!");
            return;
        }
    
    
    //parse all values to Floats to avoid errors
    a = parseFloat(a);

    b = parseFloat(b);

    c = parseFloat(c);
    
    
    var min;
    
    
    if ( (a <= b) && ( a <= c ))
        {
            min = a;
        }
    else if ( (b <= c ) && (b <= a))
        {
            min = b;
        }
    else if ( (c <= a) && ( c <= b))
        {
            min = c;
        }
    else{
        min = "Couldn't find min.";
    }
    
    var max;
    if( (a >= b) && ( a >= c ) )
        {
            max = a;
        }
    else if ( ( b >= c ) && ( b >= a))
        {
            max = b;
        }
    else if ( ( c >= a) && ( c >= b) )
        {
            max = c;
        }
    else{
        max = "Couldn't find max.";
    }
    
    var avg = ((a + b + c) / 3 );
   
    
    var med = ( (a + b + c) - (max + min) );
    
    var range = (max - min);
    
    document.getElementById('min').value = +min;
    
    document.getElementById('max').value = +max;
    
    document.getElementById('avg').value = +avg;
    
    document.getElementById('med').value = +med;
    
    document.getElementById('range').value = +range;
     
    
}

//Clear all fields
function formReset()
{
    document.getElementById("numbers").reset();
    document.getElementById("output").reset();
}

