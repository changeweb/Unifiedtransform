<?php

namespace App\Http\Controllers;

use App\AccountSector;
use App\Account;
use App\Myclass;
use App\User;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Requests\Account\StoreSectorRequest;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Services\Account\AccountService;

class AccountController extends Controller
{

  protected $accountSectors;

  public function __construct(AccountService $accountSectors){
    $this->accountSectors = $accountSectors;
  }

  public function sectors(){
    $sectors= $this->accountSectors->getSectorsBySchoolId();
    $this->accountSectors->account_type = 'income';
    $incomes = $this->accountSectors->getAccountsBySchoolId();
    $this->accountSectors->account_type = 'expense';
    $expenses = $this->accountSectors->getAccountsBySchoolId();
    $sector = [];
    return view('accounts.sector',compact('sectors','sector','incomes','expenses'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return Response
  */
  public function storeSector(StoreSectorRequest $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->storeSector();

    return back()->with("status","Account Sector Created Succesfully.");
  }

  /**
  * Store a newly created resource in storage.
  *
  * @return Response
  */
  public function editSector($id){
    $sector = AccountSector::find($id);
    return view('accounts.edit_sector',compact('sector'));
  }


  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function updateSector(StoreSectorRequest $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->updateSector();
    return back()->with("status","Account Sector Updated Successfully.");
  }

  /**
  * Delete the specified resource.
  *
  * @param  int  $id
  * @return Response
  */
  public function deleteSector($id){
    $sector = AccountSector::find($id);
    $sector->delete();
    return redirect('/accounts/sectors')->with("status","Account Sector Deleted Successfully.");
  }

  public function income(){
    $sectors = AccountSector::bySchool(\Auth::user()->school_id)
                                ->where('type','income')
                                ->get();
    //$sections = $this->accountSectors->getSectionsIds();
    //$students = $this->accountSectors->getStudentsBySectionIds();
    return view('accounts.income',[
      'sectors'=>$sectors,
      //'sections'=>$sections,
      //'students'=>$students,
    ]);

  }
  public function storeIncome(StoreAccountRequest $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->account_type = 'income';
    $this->accountSectors->storeAccount();

    return back()->with("status","Income saved Successfully.");
  }

  public function listIncome(){
    $incomes = [];
    return view('accounts.income-list',['incomes'=>$incomes]);
  }

  public function postIncome(Request $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->account_type = 'income';
    $incomes = $this->accountSectors->getAccountsByYear();

    return view('accounts.income-list',compact('incomes'));
  }

  public function editIncome($id){
    $income = Account::find($id);
    return view('accounts.income-edit',compact('income'));
  }
  public function updateIncome(UpdateAccountRequest $request)
  {
    $this->accountSectors->request = $request;
    $this->accountSectors->updateAccount();

    return back()->with("status","Income Updated Successfully.");
  }

  public function deleteIncome($id){
    $income = Account::find($id);
    $income->delete();

    return back()->with("status","Income Deleted Successfully.");
  }

  public function expense(){
    $sectors = AccountSector::bySchool(\Auth::user()->school_id)
                                ->where('type','expense')
                                ->get();
    return view('accounts.expense',['sectors'=>$sectors]);

  }
  public function storeExpense(StoreAccountRequest $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->account_type = 'expense';
    $this->accountSectors->storeAccount();

    return back()->with("status","expense saved Successfully.");
  }

  public function listExpense(){
    $expenses = [];
    return view('accounts.expense-list',['expenses'=>$expenses]);
  }

  public function postExpense(Request $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->account_type = 'expense';
    $expenses = $this->accountSectors->getAccountsByYear();

    return view('accounts.expense-list',compact('expenses'));
  }

  public function editExpense($id){
    $expense = Account::find($id);
    return view('accounts.expense-edit',['expense'=>$expense]);
  }

  public function updateExpense(UpdateAccountRequest $request){
    $this->accountSectors->request = $request;
    $this->accountSectors->updateAccount();

    return back()->with("status","expense Updated Successfully.");
  }

  public function deleteExpense($id){
    $expense = Account::find($id);
    $expense->delete();
    return back()->with("status","expense Deleted Successfully.");
  }
}
