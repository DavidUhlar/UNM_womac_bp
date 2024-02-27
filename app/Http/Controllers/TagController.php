<?php

namespace App\Http\Controllers;

use App\Models\Oznam;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function indexTag($id)
    {

        $oznam = Oznam::find($id);
        $tags = Tag::all();
        $associatedTags = $oznam ? $oznam->tag->pluck('id')->toArray() : [];

        return view('oznam.oznamTags', compact('oznam', 'tags', 'associatedTags'));
    }

    public function associateTag(Request $request, $oznamId)
    {

        $tagId = $request->input('tags');
        $oznam = Oznam::find($oznamId);
        $oznam->tag()->sync($tagId);

        return redirect()->route('oznam.oznam');
    }

    public function tagMenu()
    {

        return view('oznam.oznamTagCreate');
    }
    public function createTag(Request $request)
    {

        $tag = Tag::create([
            'nazov' => $request->nazov,
        ]);
        $tag->save();

        return redirect()->route('oznam.oznam');
    }

    public function tagMenuDelete()
    {
        $tags = Tag::all();
        return view('oznam.oznamTagDelete', compact( 'tags'));
    }
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
