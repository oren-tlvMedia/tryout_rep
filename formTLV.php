<HTML>
<HEAD>
<h1> Exercise Tester</h1>
<style> 
h1
{
color:white;
text-align:center;
}
body
 {
background-color:grey;
}
</style>
</HEAD>
<BODY>

<!--<div id="output">waiting for action</div>-->

<p> enter the file name<input type ="text" size="5"  name="name"/> </p> 
<textarea name = "text"  id="myText" rows="4" cols="50" >
text here...</textarea>
<!--<a href="#" onclick="return getOutput();"> submit </a>-->

<!--<p><input type="radio" name="insensitive" value="True"/>Insensitive
   </p> 
	 

<input type="submit" name="submit" value="Submit"> -->


<script>
function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","tlvEX.php?text=aaa AAA asd aax aaa&name=bla&insensitive=True",true);
xmlhttp.send();
}
</script>


<div id="myDiv"><h2>Let AJAX change this text</h2></div>
<button type="button" onclick="loadXMLDoc()">Change Content</button>
<!--handles the click event for link 1, sends the query
// function getOutput() {
  // getRequest(
      // 'tlvEX.php', // URL for the PHP file
       // drawOutput,  // handle successful request
       // drawError    // handle error
  // );
  // return false;
// }  
handles drawing an error message
// function drawError () {
    // var container = document.getElementById('output');
    // container.innerHTML = 'Bummer: there was an error!';
// }
handles the response, adds the html
// function drawOutput(responseText) {
    // var container = document.getElementById('output');
    // container.innerHTML = responseText;
// }
helper function for cross-browser request object
// function getRequest(url, success, error) {
    // var req = false;
    // try{
        most browsers
        // req = new XMLHttpRequest();
    // } catch (e){
        IE
        // try{
            // req = new ActiveXObject("Msxml2.XMLHTTP");
        // } catch (e) {
            try an older version
            // try{
                // req = new ActiveXObject("Microsoft.XMLHTTP");
            // } catch (e){
                // return false;
            // }
        // }
    // }
    // if (!req) return false;
    // if (typeof success != 'function') success = function () {};
    // if (typeof error!= 'function') error = function () {};
    // req.onreadystatechange = function(){
        // if(req .readyState == 4){
            // return req.status === 200 ? 
                // success(req.responseText) : error(req.status)
            // ;
        // }
    // }
    // req.open("GET", url, true);
    // req.send(null);
    // return req;
// }

 </script>-->




</BODY>




</HTML>