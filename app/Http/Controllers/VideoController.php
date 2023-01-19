<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function writeFile($name_file, $json_file)
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

    public function done()
    {
        $files =
            [
                'grace_in_the_mind',
                'law_and_grace_part_1',
                'the_human_expression_of_god',
                'what_is_your_rank_in_the_kingdom',
                'your_oneness_with_god',
            ];


        foreach ($files as $file)
        {
            $this->writeFile($file, $file.'.json');
        }
    }

    public function JsonDataView(Request $request)
    {

    }

    public function getJsonData(Request $request)
    {

    }

    public function saveVideo(Request $request)
    {

    }


}
