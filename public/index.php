<?php

main::start("example.csv");

 class main
 {

     static public function start($filename){
         $records= csv::getRecords($filename);
         $table= html::generateTable($records);
         print_r($table);
     }
}

class csv{
    static public function getRecords($filename){

        $header = 0;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE ) {
            while (($row = fgetcsv($handle, 1000, ',')) !== FALSE)
            {
                if($header == 0){
                    $header = $row;
                }else{
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}
class html
{

    static public function generateTable($records)
    {

        $html = '<html><body><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"><<table class="table table-striped" border="1">';
        $html .= '<tr>';
        $headings = $records[0];
        foreach ($headings as $key => $value) {
            $html .= '<th scope="col">' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        foreach ($records as $array) {
            $html .= '<tr>';
            foreach ($array as $key2 => $value2) {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table></body></html>';
        return $html;
    }
}
class system
{

    static public function printPage($page)
    {
        print $page;
    }
}