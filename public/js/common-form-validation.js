$('.numberonly').keypress(function (e) 
{
    var charCode = (e.which) ? e.which : event.keyCode
    if (String.fromCharCode(charCode).match(/[^0-9]/g))
        return false;
});

$(".onlyalphabetsspace").keypress(function (event) 
{
    var inputValue = event.charCode;
    if (!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) {
        event.preventDefault();
    }
});

// $(".onlyalphabetsspace").keypress(function (event) 
// {
//     if (this.value.length === 0 && event.which === 32) 
//     {
//         event.preventDefault();
//     }
// });

// $(".onlynumber").keypress(function (event) 
// {
//     if (this.value.length === 0 && event.which === 32) {
//         event.preventDefault();
//     }
// });

$(".onlynumbers").keypress(function (e) 
{
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
    }
});

$('.spacenotallow').on('keypress', function (e) 
{
    if (e.which == 32) {
        return false;
    }
});

function process(input) 
{
    let value = input.value;
    let numbers = value.replace(/[^0-9]/g, "");
    input.value = numbers;
}

function process1(input)
{
    let value = input.value;
    let numbers = value.replace(/[^0-9]/g, "");
    if (input.value == "0")
    {
        input.value = "";
    }
    else
    {
        input.value = numbers;
    }  
}

function toUpper(e){
    setTimeout(function(){
      let v = e.target.value.toUpperCase();
    e.target.value = v;
    },100);
  }