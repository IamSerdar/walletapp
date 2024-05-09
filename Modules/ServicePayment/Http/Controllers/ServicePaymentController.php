<?php

namespace Modules\ServicePayment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\ServicePayment\Entities\ServicePayment;
use Modules\ServicePayment\Services\ServicePaymentManager;
use Modules\User\Entities\User;

class ServicePaymentController extends Controller
{
    protected $servicePaymentManager;

    public function __construct(ServicePaymentManager $servicePaymentManager)
    {
        $this->servicePaymentManager = $servicePaymentManager;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable'],
            'status' => ['nullable'],
        ]);

        $query = ServicePayment::query();
        if (@$filters['search']) {
            $search = $filters['search'];
            $query->where(function($query) use ($search) {
                $query
                ->whereRaw('LOWER(from_address) LIKE ? ',['%'.trim(strtolower($search)).'%'])
                ->orwhereRaw('LOWER(to_address) LIKE ? ',['%'.trim(strtolower($search)).'%'])
                ->orWhereHas('user', function ($q) use ($search){
                    $q->whereRaw('LOWER(username) LIKE ? ',['%'.trim(strtolower($search)).'%']);
                });
            });
        }
        if (@$filters['status'] && $filters['status'] != 'all') {
            if ($filters['status'] != 'all')
            $query->where('status', $filters['status']);
        }

        $count = $query->count();
        $servicePayments = $query->latest()->paginate(10);
        return view('servicepayment::index', compact('servicePayments', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::query()->whereRole(User::ROLE_CUSTOMER)->get();
        return view('servicepayment::create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->servicePaymentManager->create($request->all());
        return redirect()->route('servicePayments.')->with([
            'success' => 'Service Payment successfully created!',
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(ServicePayment $servicePayment)
    {
        return view('servicepayment::show', compact('servicePayment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ServicePayment $servicePayment)
    {
        $statuses = ServicePayment::defaultStatus();
        $users = User::query()->whereRole(User::ROLE_CUSTOMER)->get();
        return view('servicepayment::edit', compact('servicePayment', 'statuses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, ServicePayment $servicePayment)
    {
        $this->servicePaymentManager->update($servicePayment, $request->all());
        $previous = $request->get('previous') ?? url()->route('servicePayments.');
        return redirect($previous)->with([
            'success' => 'Service Payment successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, ServicePayment $servicePayment)
    {
        $servicePayment->delete();
        $previous = $request->get('previous') ?? url()->route('servicePayments.');
        return redirect($previous)->with([
            'danger' => 'Service Payment successfully deleted!',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = $request->validate([
            'service_payment_id' => ['required', 'exists:service_payments,id'],
            'status' => ['required', Rule::in(ServicePayment::defaultStatus())],
        ]);
        $servicePayment = ServicePayment::find($data['service_payment_id']);
        $servicePayment->status = $data['status'];
        $servicePayment->save();

        return redirect()->back()->with('success', 'Status Changed!');
    }
}
