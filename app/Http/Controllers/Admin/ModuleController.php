<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Zip;

class ModuleController extends Controller
{

    public function importMe(Request $request)
    {
        $zip = Zip::open(public_path() . '/twilio.zip');
        $fileList = $zip->listFiles();

        foreach ($fileList as $value) {
            $result = $this->fileExits($value, 'Controllers/');
            if ($result) {
                echo $result . "<br>";
                //$extract = $zip->extract(base_path('app/Http/'), $result);
            }
        }

        foreach ($fileList as $value) {
            $result = $this->fileExits($value, 'views/');
            if ($result) {
                echo $result . "<br>";

            }
        }

        $routeData = $zip->getFromName('web.php');
        file_put_contents(
            '../Controllers/../routes/web.php',
            $routeData,
            FILE_APPEND
        );

        return "tana";

    }
    public function fileExits($fileName, $regx)
    {
        $contains = Str::startsWith($fileName, $regx);
        $after = Str::after($fileName, $regx);
        $endWith = Str::endsWith($fileName, '.php');
        if ($contains && $after && $endWith) {
            return $fileName;
        }
        return false;
    }
    public function textLocal()
    {

        $apiKey = urlencode('XvRVs2ByMk8-xnRJuMTe2MkqxPiDDTovGFPQ2g75h3');
        $numbers = array(918487013103);
        $sender = urlencode('TXTLCL');
        $message = rawurlencode('Hi , how are you odkhan padi k nay kon e');
        $numbers = implode(',', $numbers);

        $data = array('apikey' => $apiKey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    }
}
