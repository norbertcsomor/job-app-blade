<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobseekerRequest;
use App\Http\Requests\UpdateJobseekerRequest;
use App\Models\Cv;
use App\Models\Jobapplication;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class JobseekersController extends Controller
{
    /**
     * Új álláskereső létrehozására szolgáló űrlap megjelenítése.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function create()
    {
        return view('jobseekers.create');
    }

    /**
     * Új álláskereső létrehozása az adatbázisban.
     * 
     * @param  \App\Http\Requests\StoreJobseekerRequest  $request a létrehozandó álláskereső adatai.
     * @return \Illuminate\Http\Responsea szerver válasza.
     */
    public function store(StoreJobseekerRequest $request)
    {
        $jobseeker = new User();
        $jobseeker->name = $request->input('name');
        $jobseeker->address = $request->input('address');
        $jobseeker->telephone = $request->input('telephone');
        $jobseeker->email = $request->input('email');
        $jobseeker->password = bcrypt($request->input('password'));
        $jobseeker->role = 'jobseeker';

        $success = $jobseeker->save();

        if ($success) {
            auth()->login($jobseeker);
            return redirect('/')
                ->with('message', 'Sikerült az álláskereső létrehozása!');
        }
    }

    /**
     * Létező álláskereső módosítására szolgáló űrlap megjelenítése.
     * 
     * @param  \App\Models\User  $jobseeker a módosítandó álláskereső adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function edit(User $jobseeker)
    {
        $cvs = Cv::where('user_id', $jobseeker->id)->get();
        return view('jobseekers.edit', compact('jobseeker', 'cvs'));
    }

    /**
     * Létező álláskereső módosítása az adatbázisban.
     * 
     * @param  \App\Http\Requests\UpdateJobseekerRequest  $request a módosítandó álláskereső adatai.
     * @param  \App\Models\User  $jobseeker az álláskereső modellje.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function update(UpdateJobseekerRequest $request, User $jobseeker)
    {
        $jobseeker->update($request->validated());

        return redirect('/')->with('message', 'Sikerült az álláskereső módosítása!');
    }

    /**
     * Létező álláskereső törlése az adatbázisból.
     * 
     * @param  \App\Models\User  $jobseeker a törlendő álláskereső adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function destroy(User $jobseeker)
    {
        $jobseeker->delete();

        return redirect('/')->with('message', 'Sikerült az álláskereső törlése!');
    }

    /**
     * Az összes létező álláskereső lekérdezése az adatbázisból.
     * 
     * @return \Illuminate\Http\Responsea szerver válasza.
     */
    public function index()
    {
        $jobseekers = User::where('role', 'jobseeker')->paginate(10);
        return view('jobseekers.index', compact('jobseekers'));
    }

    /**
     * Az álláskereső összes jelentkezésének lekérdezése az adatbázisból.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function jobapplications()
    {
        $user = User::find(auth()->user()->id);
        $jobapplications = Jobapplication::with('jobadvertisement', 'cv')->where('user_id', $user->id)->get();
        return view('jobseekers.jobapplications', compact('jobapplications'));
    }
}
