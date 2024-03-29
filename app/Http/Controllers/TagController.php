<?php

namespace App\Http\Controllers;

use App\Models\Oznam;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * vráti pohľad oznam.oznamTags, v ktorom sa nachádza formulár na prideľovanie tagov danému prípevku.
     * Zobrazujú sa všetky dostupné tagy a zaškrtnuté sú tie, ktoré sú práve priradené k danému príspevku.
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function indexTag($id)
    {

        $oznam = Oznam::find($id);
        $tags = Tag::all();
        $associatedTags = $oznam ? $oznam->tag->pluck('id')->toArray() : [];

        return view('oznam.oznamTags', compact('oznam', 'tags', 'associatedTags'));
    }

    /**
     * na základe výstupov z formuláru sa v tejto metóde prepoja určené tagy s daným oznamom.
     *
     * @param Request $request
     * @param $oznamId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function associateTag(Request $request, $oznamId)
    {

        $tagId = $request->input('tags');
        $oznam = Oznam::find($oznamId);
        $oznam->tag()->sync($tagId);

        return redirect()->route('oznam.oznam');
    }

    /**
     * vráti pohľad oznam. oznamTagCreate, v ktorom sa nachádza formulár na vytvorenie tagov.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tagMenu()
    {

        return view('oznam.oznamTagCreate');
    }


    /**
     * na základe výstupov z formuláru sa v tejto metóde vytvorí nový tag
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTag(Request $request)
    {
        $request->validate([
            'nazov' => 'required|min:4',
        ]);
        $tag = Tag::create([
            'nazov' => $request->nazov,
        ]);
        $tag->save();

        return redirect()->route('oznam.oznam');
    }

    /**
     * vráti pohľad oznam.oznamTagDelete, v ktorom sa nachádza formulár na vymazanie existujúcich tagov.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tagMenuDelete()
    {
        $tags = Tag::all();
        return view('oznam.oznamTagDelete', compact( 'tags'));
    }

    /**
     * na základe výstupov z formuláru sa v tejto metóde vymažu určené tagy
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTag(Request $request)
    {
        $tagIds = $request->input('tags', []);

        if (empty($tagIds)) {
            return redirect()->route('oznam.oznam');
        }

        Tag::destroy($tagIds);
        return redirect()->route('oznam.oznam');
    }

}
