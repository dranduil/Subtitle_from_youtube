<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function writeFile($name_file)
    {
        $string = Storage::disk('public')->get($name_file.'.json');
        $json = json_decode($string, true);
        $data = $json['actions'][0]['updateEngagementPanelAction']["content"]["transcriptRenderer"]["content"]["transcriptSearchPanelRenderer"]["body"]["transcriptSegmentListRenderer"]["initialSegments"];

        $file_temp_content = "";
        foreach($data as $value)
        {
            $temp = $value["transcriptSegmentRenderer"]["startTimeText"]["simpleText"];
            $text = str_replace("\n", "", $value["transcriptSegmentRenderer"]["snippet"]["runs"][0]["text"]);

            // Append a new person to the file
            $file_temp_content .= $temp."\t".$text."\n";
        }

        // Write the contents back to the file
        Storage::disk('public')->put("{$name_file}.txt", $file_temp_content);

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
            $this->writeFile($file);
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
