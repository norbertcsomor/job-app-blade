<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobadvertisementRequest;
use App\Http\Requests\UpdateJobadvertisementRequest;
use App\Models\Jobadvertisement;
use App\Models\Jobapplication;

class JobadvertisementsController extends Controller
{
    /**
     * Új álláshirdetés létrehozására szolgáló űrlap megjelenítése.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function create()
    {
        return view('jobadvertisements.create');
    }

    /**
     * Új álláshirdetés létrehozása az adatbázisban.
     * 
     * @param  \App\Http\Requests\StoreJobadvertisementRequest  $request a létrehozandó álláshirdetés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function store(StoreJobadvertisementRequest $request)
    {
        $jobadvertisement = new Jobadvertisement();
        $jobadvertisement->user_id = auth()->user()->id;
        $jobadvertisement->title = $request->input('title');
        $jobadvertisement->location = $request->input('location');
        $jobadvertisement->description = $request->input('description');

        // dd($jobadvertisement);

        $success = $jobadvertisement->save();

        if ($success) {
            return redirect('/employers/jobadvertisements')
                ->with('message', 'Sikerült az álláshirdetés létrehozása!');
        }
    }

    /**
     * Létező álláshirdetés módosítására szolgáló űrlap megjelenítése.
     * 
     * @param  \App\Models\Jobadvertisement  $jobadvertisement a módosítandó álláshirdetés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function edit(Jobadvertisement $jobadvertisement)
    {
        return view('jobadvertisements.edit', compact('jobadvertisement'));
    }

    /**
     * Létező álláshirdetés módosítása az adatbázisban.
     * 
     * @param \App\Http\Requests\UpdateJobadvertisementRequest  $request a módosítandó álláshirdetés adatai.
     * @param  \App\Models\Jobadvertisement  $employer $jobadvertisement az álláshirdetés modellje.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function update(UpdateJobadvertisementRequest $request, Jobadvertisement $jobadvertisement)
    {
        $jobadvertisement->update($request->validated());

        return redirect('/employers/jobadvertisements')->with('message', 'Sikerült az álláshirdetés módosítása!');
    }

    /**
     * Létező álláshirdetés törlése az adatbázisból.
     * 
     * @param  \App\Models\Jobadvertisement  $jobadvertisement a törlendő álláshirdetés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function destroy(Jobadvertisement $jobadvertisement)
    {
        $jobadvertisement->delete();

        return redirect('/')->with('message', 'Sikerült az álláshirdetés törlése!');
    }

    /**
     * Az összes létező álláshirdetés lekérdezése az adatbázisból.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function index()
    {
        $jobadvertisements = Jobadvertisement::with(['user'])
            ->orderBy('created_at', 'desc')
            ->filter(request(['search']))
            ->paginate(10);
        return view('jobadvertisements.index', compact('jobadvertisements'));
    }

    /**
     * Létező álláshirdetés lekérdezése az adatbázisból.
     * 
     * @param  \App\Models\Jobadvertisement  $jobadvertisement az álláshirdetés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function show(Jobadvertisement $jobadvertisement)
    {
        $jobapplications = Jobapplication::where('jobadvertisement_id', $jobadvertisement->id)->get();
        return view('jobadvertisements.show', compact('jobadvertisement', 'jobapplications'));
    }
}
