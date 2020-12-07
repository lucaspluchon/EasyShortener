/*
    Link between PHP Api and User Interface i may use AJAX later
*/

function link_short()
{
    var url = document.getElementById("url_input").value;
    var result_div = document.getElementById("result");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            var reponse = this.responseText.trim();
            if (reponse == "link_not_valid")
            {
                result_div.style.display = "none";
                document.getElementById("error").style.display = "block";
                document.getElementById("error_text").innerHTML = "Link is not valid !";
            }
            else if (reponse == "too_many_request")
            {
                result_div.style.display = "none";
                document.getElementById("error").style.display = "block";
                document.getElementById("error_text").innerHTML = "You did too many request today !";
            }
            else
            {
                var result_link = document.getElementById("result_link");
                result_div.style.display = "block";
                document.getElementById("error").style.display = "none";
                result_link.href = "http://localhost/" + reponse;
                result_link.innerHTML = "localhost/" + reponse;
            }
        }
    };
    request.open("GET", "shorten.php?url=" + url, true);
    request.send();
}

function copy_clipboard()
{
    var link = document.getElementById("result_link").href;
    if (navigator.clipboard != undefined) //Chrome
    {
        navigator.clipboard.writeText(link)
    }
    else if(window.clipboardData) // Internet Explorer
    { 
        window.clipboardData.setData("Text", link);
    }
}