<?php
function write_file($name_file, $json_file)
{
    $string = file_get_contents($json_file.'.json');
    $json = json_decode($string, true);
    $data = $json['actions'][0]['updateEngagementPanelAction']["content"]["transcriptRenderer"]["body"]["transcriptBodyRenderer"]["cueGroups"];


    $file = $name_file.'.txt';
    // Open the file to get existing content
    $current = file_get_contents($file);
    foreach($data as $value)
    {
        $temp = $value["transcriptCueGroupRenderer"]["formattedStartOffset"]["simpleText"];
        $text = $value["transcriptCueGroupRenderer"]["cues"][0]["transcriptCueRenderer"]["cue"]["simpleText"];

        // Append a new person to the file
        $current .= $temp."\t".$text."\n";
    }
    
    // Write the contents back to the file
    file_put_contents($file, $current);

    return true;
}

write_file("elsacerdocio_de_melquisedec","elsacerdocio_de_melquisedec");
write_file("Mensaje_desupes_de_la_tumba","Mensaje_desupes_de_la_tumba");


?>