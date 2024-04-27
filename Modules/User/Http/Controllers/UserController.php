<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\User\Entities\User;
use Modules\User\Services\UserManager;

class UserController extends Controller
{
    protected $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable'],
        ]);

        $query = User::query();
        if (@$filters['search']) {
            $search = $filters['search'];
            $query->where(function($query) use ($search) {
                $query
                ->whereRaw('LOWER(username) LIKE ? ',['%'.trim(strtolower($search)).'%']);
            });
        }

        $count = $query->count();
        $users = $query->latest()->paginate(10);
        return view('user::index', compact('users', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = User::defaultRoles();
        return view('user::create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->userManager->create($request->all());
        $previous = $request->get('previous') ?? url()->route('users.');
        return redirect($previous)->with([
            'success' => 'User successfully created!',
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(User $user)
    {
        return view('user::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        $roles = User::defaultRoles();
        return view('user::edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, User $user)
    {
        $this->userManager->update($user, $request->all());
        $previous = $request->get('previous') ?? url()->route('users.');
        return redirect($previous)->with([
            'success' => 'User successfully updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with([
            'danger' => 'User successfully deleted!',
        ]);
    }
}
