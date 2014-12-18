<HTML>

<head>
<style>
table, th{
    border: 1px solid blue;
	border-collapse: collapse;
}

</style>
</head>
<BODY>
<p> 
<a href="http://localhost/formTLV.php" >Back<a/>
</p>
<?PHP
error_reporting(E_ERROR | E_WARNING | E_PARSE);
const SECTIONS = 5;

//an aux class
class pair
{
	public function __construct($key,$val)
	{
		$this->key = $key;
		$this->val = $val;
	}
	public $val;
	public $key;
}

class Histogram
{
    private $arr ;
	private $sectionsArr = array();
    private $counter = 0;
	private $is_insens ;
	//if the user enters a valid file name and a text, this class will consider both and will add the 
	//words that were given from the file to the text
	public function __construct($name,$textBox,$isFile=false,$isText=false, $is_insens)
	{
		$this->arr = array();
		$this->is_insens = $is_insens;
		if ($isFile==true) $this->fileReader($name);
			
		if ($isText==true) $this->readLine($textBox);
	
	}
	
function fileReader($fileName)
{

	$myfile = fopen($fileName, "r") or die("Unable to open file!");
	
	
	 while(!feof($myfile)) 
	 {
		$str = fgetss($myfile);
		$this->readLine($str);
	 }
	unset($tokens);
	fclose($myfile);
}	

function readLine(&$line)
{
	if (isset($this->is_insens )) 	
		$line = strtolower($line);
	
	$tokens = preg_split('/[\s\n\t]+/', $line);
		foreach ($tokens as $word )
		{
			if ($word == '') continue;//should find out how to eliminate those blanks without this if
			$this->arr[$word] = isset($this->arr[$word])?$this->arr[$word]+1:1;
			$this->counter++;
		}	

}

function mySort(&$arr) 
{
	arsort($arr);	
	$vals = array_count_values($arr);
	$i = 0;
    foreach ($vals as $val=>$num)
	{
        $first = array_splice($arr,0,$i);
        $tmp = array_splice($arr,0,$num);
        ksort($tmp); 
        $arr = array_merge($first,$tmp,$arr);
        unset($tmp);
        $i += $num;       
    }
	$this->is_sorted= true;
}
	function printElement($key,$value)
	{
		echo("<tr>");
		echo("<td> $key </td>");
		echo("<td> $value </td>");
		echo("</tr>");
	}


	function output()
 {
	
	 $this->mySort($this->arr);
	 echo ("there are $this->counter words.<br/>");
	 echo ("<table border='1'>");
	 echo("<tr> <th>Word</th> ");
	 echo("<th>Occurrences</th> </tr>");
	foreach($this->arr as $key => $value) 
	{		
		$this->printElement($key,$value);
	}
	echo ("</table>");	
 }
 
	function outputSections()
	{
		echo ("there are $this->counter words.<br/>");
		echo ("<table border='1'>");
		echo("<tr> <th>Word</th> ");
		echo("<th>Occurrences</th> </tr>");
		for ($i=0;$i<5;$i++)
		{
			$element = array_pop($this->sectionsArr[$i]);			
			$this->printElement($element->key,$element->val);
		}
		echo ("</table>");
	}
	
	function sectionsSplit()
	{
		$num_in_each_section = round($this->counter/SECTIONS);
		$this->mySort($this->arr);
		
		for ($i=0;$i<5;$i++) $this->sectionsArr[$i] = array(); // TO DO: change magic number
		
		$i=0;	
		$room_left = $num_in_each_section;//the number of  words that remains to insert 
		foreach($this->arr as $key => $value)
		{
			//array_push($this->sectionsArr[$i],new pair($key,$value));
			$this->sectionsArr[$i][] = new pair($key,$value);
			$room_left -= $value;
			$i += $room_left<=0? 1:0;//if there is no room in this bucket increment 'i'
			
			//a negative 'room_left' means that its absolute number is the times this word will appear in the next bucket
			while ($room_left < 0)
			{
				//array_push($this->sectionsArr[$i++],new pair($key,$value));
				$this->sectionsArr[$i][] = new pair($key,$value);
				$room_left += $num_in_each_section;
				$i += $room_left<=0? 1:0;
			}			
			$room_left = $room_left==0?$num_in_each_section:$room_left;							
		}						
	}
	
		      
}
			  
	$fileName=$_GET['name'];
	$text = $_GET['text'];
	$is_insens =  $_GET['insensitive'];
	//if(empty($is_sens) ==true ) $is_sens = false;	
		
		function runHistogram($text,$name,$is_insens)
		{
			$his = new Histogram($fileName,$text,!empty($fileName),!empty($text),$is_insens);
			$his->output();
			echo("<br/><br/>---Section Test ----- .<br/><br/>");
			$his->sectionsSplit();
			$his->outputSections();
		}

?>
</BODY>
</HTML>