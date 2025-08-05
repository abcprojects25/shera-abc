<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Media;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class NewMediaController extends Controller
{

public function index(Request $request)
{
    $mediaItems = Media::latest()->paginate(20);
    
    if ($request->ajax()) {
        return response()->json([
            'html' => view('media_items', ['mediaItems' => $mediaItems])->render(),
            'hasMore' => $mediaItems->hasMorePages()
        ]);
    }
    
    return view('admin.blog.media', compact('mediaItems'));
}





public function store(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        $timestamp = now()->format('YmdHis'); // e.g., 20250607102130
        $randomStr = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 3);
        $extension = $file->getClientOriginalExtension();
        $filename = $timestamp . '-' . $randomStr . '.' . $extension;

        $mimeType = $file->getClientMimeType();
        $fileSize = $file->getSize();
        $originalName = $file->getClientOriginalName();

        // Save the file
        $file->storeAs('media', $filename, 'public');

        // Save the media record
        $media = Media::create([
            'file_name'    => $originalName,
            'file_path'    => $filename,
            'mime_type'    => $mimeType,
            'file_size'    => $fileSize,
            'title'        => '',
            'alt_text'     => '',
            'description'  => '',
        ]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'media' => $media
        ]);
    }

    return response()->json(['message' => 'No file uploaded'], 422);
}





public function selectMedia(Request $request)
{
    $request->validate([
        'selected_media' => 'required|exists:media,id',
        'title' => 'nullable|string|max:255',
        'alt_text' => 'nullable|string|max:255',
    ]);

    $media = Media::findOrFail($request->selected_media);
    $media->update([
        'title' => $request->title,
        'alt_text' => $request->alt_text,
    ]);

    return back()->with('success', 'Media selected and updated.');
}




public function fetch()
{
    $media = Media::orderByDesc('created_at')->get();

    return response()->json([
        'success' => true,
        'media' => $media
    ]);
}

public function show($id)
{
    $media = Media::findOrFail($id);
    return response()->json($media);
}

public function update(Request $request, Media $media)
{
    $request->validate([
        'alt_text' => 'nullable|string|max:255'
    ]);

    $media->update([
        'alt_text' => $request->input('alt_text')
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Alt text updated successfully'
    ]);
}

public function destroy($id)
{
    $media = Media::findOrFail($id);

    if ($media->file_path && Storage::disk('public')->exists('media/' . $media->file_path)) {
        Storage::disk('public')->delete('media/' . $media->file_path);
    }

    $media->delete();

    return response()->json(['success' => true, 'message' => 'Media deleted successfully.']);
}





// MediaController.php
public function latest()
{
    $media = Media::orderBy('created_at', 'desc')->take(8)->get();

    return response()->json($media);
}



}
