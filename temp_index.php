<?php
function write_file($name_file, $json_file)
{
    $string = file_get_contents($json_file.'.json');
    $json = json_decode($string, true);
    $data = $json['actions'][0]['updateEngagementPanelAction']["content"]["transcriptRenderer"]["content"]["transcriptSearchPanelRenderer"]["body"]["transcriptSegmentListRenderer"]["initialSegments"];


    $file = $name_file.'.txt';
    // Open the file to get existing content
    $current = file_get_contents($file);
    foreach($data as $value)
    {
        $temp = $value["transcriptSegmentRenderer"]["startTimeText"]["simpleText"];
        $text = str_replace("\n", "", $value["transcriptSegmentRenderer"]["snippet"]["runs"][0]["text"]);

        // Append a new person to the file
        $current .= $temp."\t".$text."\n";
    }

    // Write the contents back to the file
    file_put_contents($file, $current);

    return true;
}

// write_file("elsacerdocio_de_melquisedec","elsacerdocio_de_melquisedec");
// write_file("Mensaje_desupes_de_la_tumba","Mensaje_desupes_de_la_tumba");
write_file("Christ_Birth_Lady_Lineage_Christmas_Message_2022","Christ_Birth_Lady_Lineage_Christmas_Message_2022");
write_file("Grace_Has_Come_The_Christmas_Story _Kirby_de_Lanerolle","Grace_Has_Come_The_Christmas_Story _Kirby_de_Lanerolle");
write_file("The_Redeeming_Lineage_The_Christmas_Story","The_Redeeming_Lineage_The_Christmas_Story");
write_file("What_is_faith_ Kirby_de_Lanerolle","What_is_faith_ Kirby_de_Lanerolle");


?>
