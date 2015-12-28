<script>
function change(type, id, url) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange=function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      consoleUp('Rows affected: ', xhttp.responseText);
    }
  };
  xhttp.open("GET", url + id, true);
  xhttp.send();
  if(type == 'project'){
    remove(type ,id);
  }
}

function remove(type, id) {
    
    var d = document.getElementById('taskmanager_'+type+id);
    d.outerHTML = '';
}

function consoleUp(action, response){
    console.log(action + ': ' + response);
}

</script>