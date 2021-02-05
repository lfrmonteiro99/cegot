<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ZipArchive;

class FileController extends Controller
{
    public function getFiles(Request $request)
    {
        $path = $request->path;
        $current = $request->current;
        $directoriesRaw = scandir($path);

        $directories = [];

        foreach ($directoriesRaw as $dir) {
            if ($dir != '.') {
                if ($dir == '..')
                    $directories[] = ['name' => $dir, 'folder' => true, 'path' => $current];
                else
                    $directories[] = ['name' => $dir, 'folder' => is_dir($path . "/" . $dir), 'path' => $path . "/" . $dir];
            }
        }

        return response()->json($directories, 200);
    }

    public function downloadFiles(Request $request)
    {
        try {
            foreach ($request->downloadsPath as $download) {
                $files[] = $download;
            }

            $filename = "storage/download.zip";
            
            if(file_exists($filename)){
                unlink($filename);
            }

            $zip = new ZipArchive;

            if ($zip->open($filename, ZIPARCHIVE::CREATE) === TRUE) {
                $zip->deleteIndex(2);
                $zip->close();
            }
            $zip = new ZipArchive;

            if ($zip->open($filename, ZipArchive::CREATE) === TRUE) {
                foreach ($files as $file) {
                    $newFilename = substr($file,strrpos($file,'/') + 1);
                    $zip->addFile($file, $newFilename);
                }
                $zip->close();
            } else {
                echo 'failed';
            }



            echo $filename;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
