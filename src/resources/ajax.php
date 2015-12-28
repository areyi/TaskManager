<script>
function changeProject(id, url) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      consoleUp('Rows affected: ', xhttp.responseText);
    }
  };
  xhttp.open("GET", url + id, true);
  xhttp.send();
  remove(id);
}

function remove(id) {
    
    var d = document.getElementById('taskmanager'+id);
    d.outerHTML = '';
}

function consoleUp(action, response){
    console.log(action + ': ' + response);
}

</script>