<?php

namespace App\Http\Controllers;

use App\Interfaces\CrudInterface;
use App\Interfaces\TrashInterface;

class TrashController extends Controller
{
    protected $trashService;
    protected $userService;

    public function __construct(TrashInterface $trashService, CrudInterface $userService)
    {
        $this->trashService = $trashService;
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

    /**
     * Restore item from trash.
     */
    public function restoreFromTrash($model, $id)
    {
        try {
            $this->trashService->restoreFromTrash($model, $id);
            return redirect()->back()->with('success', 'Restored successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }

    /**
     * Delete item from trash.
     */
    public function deleteFromTrash($model, $id)
    {
        try {
            $this->trashService->deleteFromTrash($model, $id);
            return redirect()->back()->with('success', 'Permanently deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', $e->getMessage() ?? 'Something went wrong!');
        }
    }
}
