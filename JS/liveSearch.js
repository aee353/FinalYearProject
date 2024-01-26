function liveSearch(searchBox)
{
    <!-- creates html tag -->
    var xml = new XMLHttpRequest();
    //let num = 0;



    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var uic = document.getElementById("txtHint")
            //uic.innerHTML= this.responseText;
            var searchResult = JSON.parse(this.responseText);

            var list = document.createElement("ul");
            for (var i =0; i < searchResult.length; i++){
                var result = document.createElement("li");
                result.textContent = searchResult[i].hotelName;
                list.appendChild(result);
            }
            uic.innerHTML = "";
            uic.appendChild(list);
        }
    };
    xml.open("GET" , "ajaxSearch.php?q=" + searchBox, true);
    xml.send();
}
<!-- created javascript file with function to avoid crowding of script code in view file -->