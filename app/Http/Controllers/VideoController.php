<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->get();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'titre_ar' => 'nullable|string|max:255',
            'titre_en' => 'nullable|string|max:255',
            'type' => 'required|in:upload,youtube',
            'video_path' => 'required',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
        ]);

        $path = '';

        if ($request->type === 'upload') {
            $path = $request->file('video_path')->store('videos', 'public');
        } else {
            $path = $this->convertToEmbedUrl($request->video_path);
        }

        Video::create([
            'titre' => $request->titre,
            'titre_ar' => $request->titre_ar,
            'titre_en' => $request->titre_en,
            'type' => $request->type,
            'video_path' => $path,
            'description' => $request->description,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);

        return redirect()->route('videos.index')->with('success', 'Vidéo ajoutée avec succès.');
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'titre_ar' => 'nullable|string|max:255',
            'type' => 'required|in:upload,youtube',
            'video_path' => $request->type === 'upload' ? 'nullable|file|mimes:mp4,mov,avi' : 'required|string',
            'description' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'titre_en' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',


        ]);

        if ($request->type === 'upload' && $request->hasFile('video_path')) {
            if ($video->type === 'upload') {
                Storage::disk('public')->delete($video->video_path);
            }
            $video->video_path = $request->file('video_path')->store('videos', 'public');
        } elseif ($request->type === 'youtube') {
            $video->video_path = $this->convertToEmbedUrl($request->video_path);
        }

        $video->titre = $request->titre;
        $video->titre_ar = $request->titre_ar;
        $video->type = $request->type;
        $video->description = $request->description;
        $video->description_ar = $request->description_ar;
        $video->titre_en = $request->titre_en;
        $video->description_en = $request->description_en;


        $video->save();

        return redirect()->route('videos.index')->with('success', 'Vidéo modifiée avec succès.');
    }
    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }
    public function destroy(Video $video)
    {
        if ($video->type === 'upload') {
            Storage::disk('public')->delete($video->video_path);
        }

        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Vidéo supprimée avec succès.');
    }

    private function convertToEmbedUrl($url)
    {
        // Transforme un lien YouTube standard en lien embed
        if (strpos($url, 'watch?v=') !== false) {
            return str_replace('watch?v=', 'embed/', $url);
        } elseif (strpos($url, 'youtu.be/') !== false) {
            $videoId = substr(parse_url($url, PHP_URL_PATH), 1);
            return 'https://www.youtube.com/embed/' . $videoId;
        }
        return $url;
    }



    public function allVideo()
    {
        $videos = Video::latest()->paginate(9); // 9 vidéos par page par exemple
        return view('fronts.video.index', compact('videos'));
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('fronts.video.show', compact('video'));
    }
}
