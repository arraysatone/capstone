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

function edit(cab){
    document.getElementById("cabName").innerHTML="<input type='text' id='cabIn' value='"+cab+"'>";

    document.getElementById("editCabinet").style.display="none";
    document.getElementById("saveCabinet").style.display="unset";
}

function save(uid){
    var cabName = document.getElementById("cabIn").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText == "Record updated successfully"){
                document.getElementById("cabName").innerHTML=cabName;
            
                
                document.getElementById("editCabinet").style.display="unset";
                document.getElementById("saveCabinet").style.display="none";

                window.location.reload();
            }else{
                alert(this.responseText);
            }
        }
        };
        xmlhttp.open("GET", "./php/updateCabinetName.php?uid=" + uid + "&name=" + cabName, true);
        xmlhttp.send();
}

function submitClick(uid){
    var temp = document.getElementById("rangeThresh").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText == "Record updated successfully"){
                var threshText = document.getElementById("successDiv");
                threshText.style.opacity = "1"; 
                setTimeout(function(){
                    threshText.style.opacity = "0"; 
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