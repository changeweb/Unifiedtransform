<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountSector;
use Illuminate\Http\Request;
use App\Services\Account\AccountService;
use App\Http\Requests\Account\StoreSectorRequest;
use App\Http\Requests\Account\StoreAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function sectors()
    {
        $sectors = $this->accountService->getSectorsBySchoolId();
        $this->accountService->account_type = 'income';
        $incomes = $this->accountService->getAccountsBySchoolId();
        $this->accountService->account_type = 'expense';
        $expenses = $this->accountService->getAccountsBySchoolId();
        $sector = [];

        return view('accounts.sector', compact('sectors', 'sector', 'incomes', 'expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSector(StoreSectorRequest $request)
    {
        $this->accountService->storeSector($request->validated());

        return back()->with('status', 'Account Sector Created Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSector(AccountSector $sector)
    {
        return view('accounts.edit_sector', compact('sector'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSector(AccountSector $sector, StoreSectorRequest $request)
    {
        $this->accountService->updateSector($sector, $request->validated());

        return back()->with('status', 'Account Sector Updated Successfully.');
    }

    /**
     * Delete the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Exception
     */
    public function deleteSector(AccountSector $sector)
    {
        $sector->delete();

        return redirect('/accounts/sectors')->with('status', 'Account Sector Deleted Successfully.');
    }

    public function income()
    {
        $sectors = AccountSector ::bySchool(\Auth ::user()->school_id)
                                 ->where('type', 'income')
                                 ->get();
        //$sections = $this->$accountService->getSectionsIds();
        //$students = $this->$accountService->getStudentsBySectionIds();
        return view('accounts.income', [
            'sectors' => $sectors,
            //'sections'=>$sections,
            //'students'=>$students,
        ]);
    }

    public function storeIncome(StoreAccountRequest $request)
    {
        $this->accountService->request = $request;
        $this->accountService->account_type = 'income';
        $this->accountService->storeAccount();

        return back()->with('status', 'Income saved Successfully.');
    }

    public function listIncome()
    {
        $incomes = [];

        return view('accounts.income-list', ['incomes' => $incomes]);
    }

    public function postIncome(Request $request)
    {
        $this->accountService->request = $request;
        $this->accountService->account_type = 'income';
        $incomes = $this->accountService->getAccountsByYear();

        return view('accounts.income-list', compact('incomes'));
    }

    public function editIncome($id)
    {
        $income = Account ::find($id);

        return view('accounts.income-edit', compact('income'));
    }

    public function updateIncome(UpdateAccountRequest $request)
    {
        $this->accountService->request = $request;
        $this->accountService->updateAccount();

        return back()->with('status', 'Income Updated Successfully.');
    }

    public function deleteIncome($id)
    {
        $income = Account ::find($id);
        $income->delete();

        return back()->with('status', 'Income Deleted Successfully.');
    }

    public function expense()
    {
        $sectors = AccountSector ::bySchool(\Auth ::user()->school_id)
                                 ->where('type', 'expense')
                                 ->get();

        return view('accounts.expense', ['sectors' => $sectors]);
    }

    public function storeExpense(StoreAccountRequest $request)
    {
        $this->accountService->request = $request;
        $this->accountService->account_type = 'expense';
        $this->accountService->storeAccount();

        return back()->with('status', 'expense saved Successfully.');
    }

    public function listExpense()
    {
        $expenses = [];

        return view('accounts.expense-list', ['expenses' => $expenses]);
    }

    public function postExpense(Request $request)
    {
        $this->accountService->request = $request;
        $this->accountService->account_type = 'expense';
        $expenses = $this->accountService->getAccountsByYear();

        return view('accounts.expense-list', compact('expenses'));
    }

    public function editExpense($id)
    {
        $expense = Account ::find($id);

        return view('accounts.expense-edit', ['expense' => $expense]);
    }

    public function updateExpense(UpdateAccountRequest $request)
    {
        $this->accountService->request = $request;
        $this->accountService->updateAccount();

        return back()->with('status', 'expense Updated Successfully.');
    }

    public function deleteExpense($id)
    {
        $expense = Account ::find($id);
        $expense->delete();

        return back()->with('status', 'expense Deleted Successfully.');
    }
}
