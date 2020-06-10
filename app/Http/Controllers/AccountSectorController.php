<?php

namespace App\Http\Controllers;

use function back;
use function view;
use function route;
use function compact;
use App\AccountSector;
use function redirect;
use App\Services\Account\AccountService;
use App\Http\Requests\Account\StoreSectorRequest;

class AccountSectorController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index()
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
    public function store(StoreSectorRequest $request)
    {
        $this->accountService->storeSector($request->validated());

        return back()->with('status', 'Account Sector Created Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AccountSector $sector)
    {
        return view('accounts.edit_sector', compact('sector'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AccountSector $sector, StoreSectorRequest $request)
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
    public function delete(AccountSector $sector)
    {
        $sector->delete();

        return redirect(route('accounts.sectors.index'))->with('status', 'Account Sector Deleted Successfully.');
    }
}
