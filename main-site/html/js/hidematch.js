hiddenID = getCookie("Hidden_MatchID");
if (hiddenID == null)
    hiddenID = "_";


function hideSelMatch() {
    if (hiddenID == "_")
        return;
    var hh = 0;
    var id = hiddenID.split("_");
    for (var i = 1; i < id.length - 1; i++) {
        if (document.getElementById("trs_" + id[i]) != null) {
            document.getElementById("trs_" + id[i]).style.display = "none";
            hh++;
        }
    }
    document.getElementById("hiddencount").innerHTML = hh;
}

hideSelMatch();

function ShowAllMatch() {
    var i, j, inputs;
    inputs = document.getElementById("ajax-loadform").getElementsByTagName("tr");
    for (var i = 0; i < inputs.length; i++)
        if (inputs[i].getAttribute("id") != null)
            inputs[i].style.display = "";

    document.getElementById("hiddencount").innerHTML = "0";
    hiddenID = "_";
    writeCookie("Hidden_MatchID", hiddenID);
}

function hidematch(mid) {
    document.getElementById("trs_" + mid).style.display = "none";
    document.getElementById("hiddencount").innerHTML = parseInt(document.getElementById("hiddencount").innerHTML) + 1;
    if (hiddenID.indexOf("_" + mid + "_") == -1)
        hiddenID += mid + "_";
    writeCookie("Hidden_MatchID", hiddenID);
}