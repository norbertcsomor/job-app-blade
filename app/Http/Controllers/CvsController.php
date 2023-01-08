<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCvRequest;
use App\Models\Cv;
use Illuminate\Support\Facades\Storage;

class CvsController extends Controller
{
    /**
     * Új önéletrajz létrehozása az adatbázisban.
     * 
     * @param  \Illuminate\Http\Requests\StoreCvRequest  $request a létrehozandó önéletrajz adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function store(StoreCvRequest $request)
    {
        $cv = new  Cv();
        $cv->user_id = auth()->user()->id;
        $cv->title = $request->input('title');
        if ($request->hasFile('path')) {
            $cv->path = $request->file('path')->store('cvs', 'public');
        }

        $cv->save();

        return redirect(session('cv_url'))->with('message', 'Sikerült az önéletrajz létrehozása!');
    }

    /**
     * Létező önéletrajz letöltése a szerverről.
     *
     * @param  \App\Models\Cv  $cv a letöltendő önéletrajz adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function show(Cv $cv)
    {
        $file = Storage::disk('public')->download($cv->path, $cv->title . '.pdf');
        return $file;
    }

    /**
     * Létező önéletrajz törlése az adatbázisból és a szerverről.
     *
     * @param  \App\Models\Cv  $cv a törlendő önéletrajz adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function destroy(Cv $cv)
    {
        $cv = Cv::find($cv->id);
        Storage::disk('public')->delete($cv->path);

        $cv->delete();

        return redirect(session('cv_url'))->with('message', 'Sikerült az önéletrajz törlése!');
    }
}
