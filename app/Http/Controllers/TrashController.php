<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudInterface;
use App\Interfaces\TrashInterface;

class TrashController extends Controller
{
    protected $userService;

    public function __construct(CrudInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all trash items.
     */
    public function index()
    {
        try {
            $users = $this->userService->index(true);
            return view('trash.index', compact('users'));
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }
}
