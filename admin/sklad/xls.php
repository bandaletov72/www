<?
if($_GET['file']!=""){
	include('xlsparser.php');
	$file = $_GET['file'];
	$sheets = parse_excel($file);
	$is=0;
    //var_dump($sheets);
    if ($sheets) {
	foreach($sheets as $sheet){
//		print "sheet #$is\n--------\n";
		foreach($sheet as $row){
			foreach($row as $col){
				if(is_array($col)){
					foreach($col as $c) print "\"$c\" ";
					print "|";
				}
				else
				print "$col|";
			}
			print"\n";
		}
		$is++;
	}
}
    else {
    print "Error parsing or unknown .xls file format";
    }
} else{
	print "Use next format path_to_php.exe sample.php excel_file.xls [> out_file]";
}


?>