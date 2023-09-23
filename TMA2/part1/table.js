function showTable(){
    var table = document.getElementById("tableVisibility");
    var rowCount = table.rows.length;
    if (rowCount > 1) {
        document.getElementById('tableVisibility').hidden = false
    } else {
        document.getElementById('tableVisibility').hidden = true
    }
}