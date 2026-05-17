<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $memories = Memory::latest()->get();
        return view('admin.index', compact('memories'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'event_date' => 'required|date',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Max 2MB per foto
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('memories', 'public');
                $photoPaths[] = $path;
            }
        }

        Memory::create([
            'title' => $request->title,
            'category' => $request->category,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'height_mdpl' => $request->height_mdpl,
            'gpx_track' => $request->gpx_track,
            'story' => $request->story,
            'photos' => $photoPaths,
        ]);

        return redirect()->route('admin.index')->with('success', 'Memori berhasil diarsipkan!');
    }

    public function destroy(Memory $memory)
    {
        // Hapus foto dari storage
        foreach ($memory->photos as $photo) {
            Storage::disk('public')->delete($photo);
        }
        
        $memory->delete();
        return back()->with('success', 'Memori dihapus.');
    }
}