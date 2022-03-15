function searchList() {
    var input, filter, ul, li, h6, i, txtValue;
    input = document.getElementById("searchValue");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchList");
    ul.style.visibility="visible";
    ul.style.opacity="1";
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        h6 = li[i].getElementsByTagName("h6")[0];
        txtValue = h6.textContent || h6.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
    if(filter == '')
    {
    ul.style.visibility="hidden";
    ul.style.opacity="0";
    }
}
