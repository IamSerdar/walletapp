<?php

namespace Modules\ServiceAccount\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\ServiceAccount\Entities\ServiceAccount;
use Modules\ServiceAccount\Services\ServiceAccountManager;
use Modules\User\Entities\User;

class ServiceAccountController extends Controller
{
    protected $serviceAccountManager;

    public function __construct(ServiceAccountManager $serviceAccountManager)
    {
        $this->serviceAccountManager = $serviceAccountManager;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = ServiceAccount::query();

        $count = $query->count();
        $serviceAccounts = $query->latest()->paginate(10);
        return view('serviceaccount::index', compact('serviceAccounts', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::query()->whereRole(User::ROLE_CUSTOMER)->get();
        return view('serviceaccount::create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->serviceAccountManager->create($request->all(), $request);
        return redirect()->route('serviceAccounts.')->with([
            'success' => 'Service Account successfully created!',
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(ServiceAccount $serviceAccount)
    {
        return view('transaction::show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ServiceAccount $serviceAccount)
    {
        $users = User::query()->whereRole(User::ROLE_CUSTOMER)->get();
        return view('serviceaccount::edit', compact('serviceAccount', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, ServiceAccount $serviceAccount)
    {
        $this->serviceAccountManager->update($serviceAccount, $request->all(), $request);
        $previous = $request->get('previous') ?? url()->route('serviceAccounts.');
        return redirect($previous)->with([
            'success' => 'Service Account successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, ServiceAccount $serviceAccount)
    {
        if (Storage::disk('service_accounts/qrcodes')->exists($serviceAccount->qrcode)) {
            Storage::disk('service_accounts/qrcodes')->delete($serviceAccount->qrcode);
        }
        $serviceAccount->delete();
        $previous = $request->get('previous') ?? url()->route('serviceAccounts.');
        return redirect($previous)->with([
            'danger' => 'Service Account successfully deleted!',
        ]);
    }
}
