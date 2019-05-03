<?php
namespace App\Services\Account;

use App\AccountSector;
use App\Account;
// use App\Myclass;
// use App\Section;
// use App\User;

class AccountService {
    public $account_type;
    public $request;

    public function getSectorsBySchoolId(){
        return AccountSector::where('school_id', auth()->user()->school_id)->get();
    }

    public function getAccountsBySchoolId(){
        return Account::where('school_id', auth()->user()->school_id)
                          ->where('type', $this->account_type)
                          ->orderBy('id', 'desc')
                          ->take(50)
                          ->get();
    }

    public function storeSector(){
        $sector = new AccountSector();
        $sector->name = $this->request->name;
        $sector->type = $this->request->type;
        $sector->school_id = auth()->user()->school_id;
        $sector->user_id = auth()->user()->id;
        $sector->save();
    }

    public function updateSector(){
        $sector = AccountSector::find($this->request->id);
        $sector->name = $this->request->name;
        $sector->type = $this->request->type;
        $sector->save();
    }

    // public function getClassIds(){
    //     return Myclass::where('school_id', \Auth::user()->school_id)
    //                         ->pluck('id');
    // }

    // public function getSectionsIds(){
    //     $classes = $this->getClassIds()->toArray();
    //     return Section::with('class')
    //                         ->whereIn('class_id', $classes)
    //                         ->get();
    // }

    // public function getStudentsBySectionIds(){
    //     $sections = $this->getSectionsIds();
    //     return User::whereIn('section_id',$sections->pluck('id')->toArray())
    //                       ->get();
    // }

    public function storeAccount(){
        $income = new Account();
        $income->name = $this->request->name;
        $income->type = $this->account_type;
        $income->amount = $this->request->amount;
        $income->description = $this->request->description;
        $income->school_id = auth()->user()->school_id;
        $income->user_id = auth()->user()->id;
        $income->save();
    }

    public function getAccountsByYear(){
        return Account::where('school_id', auth()->user()->school_id)
                          ->where('type', $this->account_type)
                          ->whereYear('created_at',$this->request->year)
                          ->get();
    }

    public function updateAccount(){
        $account = Account::find($this->request->id);
        $account->amount = $this->request->amount;
        $account->description = $this->request->description;
        $account->save();
    }
}