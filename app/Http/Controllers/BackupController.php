<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index(){
        $backups = Storage::files('laravel-backup');
        return view('admin.backups.index', compact('backups'));
    }

    public function create(){
        try {
            Artisan::call('backup:run');
            return redirect()->route('admin.backups.index')
                ->with('mensaje','Copia de Seguridad Creada Correctamente')
                ->with('icono','success');
        }catch (\Exception $e){
            return redirect()->route('admin.backups.index')
                ->with('mensaje','Error: '.$e->getMessage())
                ->with('icono','error');
        }
    }

    public function descargar($nombreArchivo)
    {
        $file ='laravel-backup/'.$nombreArchivo;
        return Storage::download($file);
    }
}
