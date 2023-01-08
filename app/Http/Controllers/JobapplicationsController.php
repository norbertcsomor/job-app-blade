<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobapplicationRequest;
use App\Http\Requests\UpdateJobapplicationRequest;
use App\Models\Cv;
use App\Models\Jobadvertisement;
use App\Models\Jobapplication;
use Illuminate\Support\Facades\DB;

class JobapplicationsController extends Controller
{
    /**
     * Új jelentkezés létrehozására szolgáló űrlap megjelenítése.
     * 
     * @param  \App\Models\Jobadvertisement  $jobadvertisement a jelentkezés alapjául szolgáló álláshirdetés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function create(Jobadvertisement $jobadvertisement)
    {
        $jobapplications = DB::table('jobapplications')
            ->where('user_id', auth()->user()->id)
            ->where('jobadvertisement_id', $jobadvertisement->id)->get()->toArray();

        if (count($jobapplications) === 0) {

            $jobadvertisement = Jobadvertisement::find($jobadvertisement->id);

            $user_id = auth()->user()->id;
            $cvs = Cv::where('user_id', $user_id)->get();
            return view('jobapplications.create', compact('jobadvertisement', 'cvs'));
        }
        return redirect('/jobseekers/jobapplications')->with('message', 'Már jelentkezett az állásra!');
    }

    /**
     * Új jelentkezés létrehozása az adatbázisban.
     * 
     * @param  \Illuminate\Http\Requests\StoreJobapplicationRequest  $request a létrehozandó jelentkezés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function store(StoreJobapplicationRequest $request)
    {
        $jobapplication = new Jobapplication();
        $jobapplication->user_id = auth()->user()->id;
        $jobapplication->jobadvertisement_id = $request->input('jobadvertisement_id');
        $jobapplication->cv_id = $request->input('cv_id');
        $jobapplication->status = 'Nincs megnézve';

        $jobapplication->save();

        return redirect('/jobseekers/jobapplications')->with('message', 'Sikerült a jelentkezés!');
    }

    /**
     * Létező jelentkezés törlése az adatbázisból.
     * 
     * @param  \App\Models\Jobapplication $jobapplication a törlendő jelentkezés adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function destroy(Jobapplication $jobapplication)
    {
        $jobapplication->delete();

        return redirect('/')->with('message', 'Visszalépett a jelentkezéstől!');
    }

    /**
     * Jelentkezés állapotának módosítása az adatbázisban.
     * 
     * @param  \App\Http\Requests\StoreJobapplicationRequest  $request a létrehozandó jelentkezés adatai.
     * @param  int  $jobapplication a módosítandó jelentkezés azonosítója.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function status(UpdateJobapplicationRequest $request, $jobapplicationId)
    {
        if ($request->input('status') == ("Elfogadva" || "Elutasítva")) {

            $jobapplication = Jobapplication::find($jobapplicationId);
            $jobapplication->status = $request->input('status');
            $jobapplication->save();
            return redirect('/jobadvertisements/' . $jobapplication->jobadvertisement_id)
                ->with('message', 'Sikerült a jelentkezés állapotának módosítása!');
        }
    }
}
