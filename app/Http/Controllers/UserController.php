<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\CrudInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(CrudInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        try {
            $users = $this->userService->index();
            return view('user.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
//        dd($request->all());
        try {
            $data = $request->only(['name', 'email', 'avatar', 'addresses']);
            $data['password'] = Hash::make($request->input('password'));
            $this->userService->createOrUpdate($data);
            return redirect()->route('users.index')->with('success', 'Added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            $user = $this->userService->show($user);
            return view('user.show', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {
            $user->load('addresses:id,name,user_id');
            return view('user.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $data = $request->only(['name', 'email', 'avatar', 'addresses']);
            $this->userService->createOrUpdate($data, $user);
            return redirect()->route('users.index')->with('success', 'Updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->id() == $user->id) {
            abort(403, 'Deleting yourself is not an option!!');
        }
        try {
            $this->userService->delete($user);
            return redirect()->back()->with('success', 'Deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Restore item from trash.
     */
    public function restoreFromTrash($id)
    {
        try {
            $this->userService->restore($id);
            return redirect()->back()->with('success', 'Restored successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Delete item from trash.
     */
    public function deleteFromTrash($id)
    {
        try {
            $this->userService->permanentDelete($id);
            return redirect()->back()->with('success', 'Permanently deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }
}
