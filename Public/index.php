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

        if(($handle = fopen($filename,"r"))!== FALSE){
            while(($data = fgetcsv($handle,'1000',",")) !== FALSE){
                $num = count($data);
                for ($c=0; $c <$num; $c++){
                    $records[]=$data;
                }
            }
            fclose($handle);
        }
        return $records;
    }
}
class html
{
    static public function createRow($row)
    {
        $html = "<tr> $row </tr>";
        return $html;

    }

    static public function generateTable($records)
    {

        $html = '<table>';
        $html .= '<tr>';
        $headings = array_shift($records);
        foreach ($headings as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr>';

        foreach ($records as $key => $value) {
            $html .= '<tr>';
            foreach ($records as $key2 => $value2) {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';

        }
        $html .= '</table>';
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