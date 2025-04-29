<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('caraousels.index', compact('carousels'));
    }

    public function create()
    {
        return view('caraousels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'title_fr' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'title_en' => 'required|string|max:255',
            'description_en' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('carousels', 'public');

        Carousel::create([
            'image_path' => $imagePath,
            'title_ar' => $request->title_ar,
            'description_ar' => $request->description_ar,
            'title_fr' => $request->title_fr,
            'description_fr' => $request->description_fr,
            'title_en' => $request->title_en,
            'description_en' => $request->description_en,
        ]);

        return redirect()->route('carousel.index')->with('success', 'Carousel créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'title_fr' => 'required|string|max:255',
            'description_fr' => 'required|string',
            'title_en' => 'required|string|max:255',
            'description_en' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('carousels', 'public');
            $carousel->image_path = $imagePath;
        }

        $carousel->title_ar = $request->title_ar;
        $carousel->description_ar = $request->description_ar;
        $carousel->title_fr = $request->title_fr;
        $carousel->description_fr = $request->description_fr;
        $carousel->title_en = $request->title_en;
        $carousel->description_en = $request->description_en;

        $carousel->save();

        return redirect()->route('carousel.index')->with('success', 'Carousel mis à jour avec succès.');
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('caraousels.edit', compact('carousel'));
    }


    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->route('carousel.index')->with('success', 'Carousel supprimé avec succès.');
    }
}
