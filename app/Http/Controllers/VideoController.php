<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function writeFile($name_file)
    {
        $string = Storage::disk('public')->get($name_file);
        $json = json_decode($string, true);
        $data = $json['actions'][0]['updateEngagementPanelAction']["content"]["transcriptRenderer"]["content"]["transcriptSearchPanelRenderer"]["body"]["transcriptSegmentListRenderer"]["initialSegments"];

        $name = str_replace("json/", "", $name_file);
        $name = str_replace(".json", "", $name);
        $name = str_replace("-", " ", $name);
        $file_temp_content = "Title Youtube : {$name}\n";
        foreach($data as $value)
        {
            $temp = $value["transcriptSegmentRenderer"]["startTimeText"]["simpleText"];
            $text = str_replace("\n", "", $value["transcriptSegmentRenderer"]["snippet"]["runs"][0]["text"]);

            // Append a new person to the file
            $file_temp_content .= $temp."\t".$text."\n";
        }

        // Write the contents back to the file
        Storage::disk('public')->put("export/{$name}.txt", $file_temp_content);

        return true;
    }

    public function done()
    {
        $files = Storage::disk('public')->allFiles('json');
        foreach ($files as $file)
        {
            $this->writeFile($file);
        }

        return true;
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
