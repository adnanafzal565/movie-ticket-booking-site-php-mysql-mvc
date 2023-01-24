/**
 * Created by Adnan on 07/01/2018.
 */

$(function() {
    BASE_URL = $("#BASE_URL").val();
});

function deleteCastRow(self) {
    self.parentElement.parentElement.remove();
    casts--;

    // Re-arrange the cast numbers
    var trs = document.getElementById("cast-tbody").children;
    for (var a = 0; a < trs.length; a++) {
        var firstTd = trs[a].children[0];
        firstTd.innerHTML = (a + 1);
    }
}

function deleteCinemaRow(self) {
    // first parentElement is the <td>
    // second parentElement is the <tr>
    self.parentElement.parentElement.remove();
    cinemas--;

    // Re-arrange the cinema numbers
    var trs = document.getElementById("cinema-tbody").children;
    for (var a = 0; a < trs.length; a++) {
        var firstTd = trs[a].children[0];
        firstTd.innerHTML = (a + 1);
    }
}

function callAjax(url, data, method, callBack) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function(response) {
            console.log(response);
            callBack(JSON.parse(response));
        }
    });
}