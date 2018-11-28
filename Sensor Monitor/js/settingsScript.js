/*
*    ArraysAtOne Capstone 2018 - Maple Leaf Foods
*
*    Kevin Baumgartner
*    Jesse Berube
*    Marc Harquail
*    Alex Ireland
*
* * * * * * * * * * * * * * * * * * * * * * * * *
*
*    settingsScript.js
*    
*    Marc Harquail
*
*/

$(document).ready(function() {
    var slide = document.getElementById("rangeThresh");
    var threshDiv = document.getElementById("textThresh");

    function updateTextInput(val) {
        document.getElementById('textThresh').value=val; 
    }

    slide.addEventListener("mousemove", function() {
        val = slide.value;
        if (val >70){
            val = 70;
        }
        else if(val < 10){
            val = 10;
        }
        document.getElementById('rangeThresh').value=val;
        document.getElementById('textThresh').value=val;
    });
});

function submitClick(uid){
    var temp = document.getElementById("textThresh").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText == "Record updated successfully"){
                var threshText = document.getElementById("successDiv");
                threshText.style.display = "inline";
                setTimeout(function(){
                    threshText.style.display = "none";
                }, 3000);
            }
            else{
                console.log(this.responseText);
            }
        }
    };
    xmlhttp.open("GET", "./php/tempchanger.php?uid="+uid+"&temp="+temp+"", true);
    xmlhttp.send();
}