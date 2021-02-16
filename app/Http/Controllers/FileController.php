<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use ZipArchive;
use Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;

class FileController extends Controller
{
    public function getFiles(Request $request)
    {
        $path = $request->path;
        $current = $request->current;
        $directoriesRaw = scandir($path);

        $directories = [];

        foreach ($directoriesRaw as $dir) {
            if ($dir != '.' && $dir != '.gitignore' && $dir != 'download.zip') {
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

            if (file_exists($filename)) {
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
                    $newFilename = substr($file, strrpos($file, '/') + 1);
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

    public function index()
    {
        $path = storage_path() . '/app/public';
        $directoriesRaw = scandir($path);

        $directories = [];

        foreach ($directoriesRaw as $dir) {
            if ($dir != '.' && $dir != '..' && is_dir($path . '/' . $dir))
                $directories[] = ['name' => $dir, 'folder' => true, 'path' => $dir];
        }

        $data = [];
        $data['directories'] = $directories;

        return view('private.files.index', $data);
    }

    public function getIndexTable()
    {
        $path = storage_path() . '/app/public';
        $directoriesRaw = scandir($path);
        foreach ($directoriesRaw as $dir) {
            if ($dir != '.' && $dir != '..' && $dir != '.gitignore' && $dir != 'download.zip' && is_dir($path . '/' . $dir)) {
                $xs = scandir($path . "/" . $dir);
                foreach ($xs as $x) {
                    if ($x != '.' && $x != '..') {
                        $newPath = $path . '/' . $x;
                        $directories[] = ['name' => $x, 'folder' => is_dir($newPath . "/" . $x), 'path' => $newPath . "/" . $x];
                    }
                }
            }
        }

        $files = Collection::make($directories);

        return DataTables::of($files)
            ->editColumn('name', function ($file) {
                return $file['name'];
            })

            ->addColumn('action', function ($file) {
                //return '<a href="'.$route.'" class="btn btn-simple btn-warning btn-icon edit" data-bs-toggle="tooltip" data-bs-placement="left" title="See"><i class="material-icons">dvr</i></a>
                //<a onclick="javascript:removeConfirmation('.$user->id.')" class="btn btn-simple btn-danger btn-icon remove" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete"><i class="material-icons">delete</i></a>';

                return '<a onclick="javascript:removeConfirmation(\'' . $file['path'] . '\')" class="btn btn-simple btn-danger btn-icon remove" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete"><i class="material-icons">delete</i></a>';
            })
            ->rawColumns(['name', 'created_at', 'action'])
            ->make(true);
    }

    public function uploadFile(Request $request)
    {
        $filenameWithExt = $request->file('doc')->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get just ext
        $extension = $request->file('doc')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        $path = $request->doc->storeAs('test_folder', $filenameWithExt, 'uploads');

        //Storage::disk('uploads')->put($filename, file_get_contents($request->file('doc')->getRealPath()));

        Session::flash('message', 'Ficheiro carregado com sucesso!');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        try {
            unlink($request->path);
            return response()->json('true', 200);
        } catch (\Throwable $t) {
            return response()->json('false', 500);
        }
    }
}
