<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\Jobadvertisement;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployersController extends Controller
{
    /**
     * Új munkaadó létrehozására szolgáló űrlap megjelenítése.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function create()
    {
        return view('employers.create');
    }

    /**
     * Új munkaadó létrehozása az adatbázisban.
     * 
     * @param  \App\Http\Requests\StoreEmployerRequest  $request a létrehozandó munkaadó adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function store(StoreEmployerRequest $request)
    {
        $employer = new User();
        $employer->name = $request->input('name');
        $employer->address = $request->input('address');
        $employer->telephone = $request->input('telephone');
        $employer->email = $request->input('email');
        $employer->password = bcrypt($request->input('password'));
        $employer->role = 'employer';

        $success = $employer->save();

        if ($success) {
            auth()->login($employer);
            return redirect('/')
                ->with('message', 'Sikerült a munkaadó létrehozása!');
        }
    }

    /**
     * Létező munkaadó módosítására szolgáló űrlap megjelenítése.
     * 
     * @param  \App\Models\User  $employer a módosítandó munkaadó adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function edit(User $employer)
    {
        return view('employers.edit', compact('employer'));
    }

    /**
     * Létező munkaadó módosítása az adatbázisban.
     *
     * @param  \App\Http\Requests\UpdateEmployerRequest  $request a módosítandó munkaadó adatai.
     * @param  \App\Models\User  $employer a munkaadó modellje.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function update(UpdateEmployerRequest $request, User $employer)
    {
        $employer->update($request->validated());

        return redirect('/')->with('message', 'Sikerült a munkaadó módosítása!');
    }

    /**
     * Létező munkaadó törlése az adatbázisból.
     * 
     * @param  \App\Models\User  $employer a törlendő munkaadó adatai.
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function destroy(User $employer)
    {
        $employer->delete();

        return redirect('/')->with('message', 'Sikerült a munkaadó törlése!');
    }

    /**
     * Az összes létező munkaadó lekérdezése az adatbázisból.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function index()
    {
        $employers = DB::table('users')->where('role', 'employer')->paginate(10);
        return view('employers.index', compact('employers'));
    }

    /** 
     * Létező munkaadó összes álláshirdetésének lekérdezése az adatbázisból.
     * 
     * @return \Illuminate\Http\Response a szerver válasza.
     */
    public function jobadvertisements()
    {
        $user = User::find(auth()->user()->id);
        $jobadvertisements = Jobadvertisement::where('user_id', $user->id)->get();
        return view('employers.jobadvertisements', compact('jobadvertisements'));
    }
}
