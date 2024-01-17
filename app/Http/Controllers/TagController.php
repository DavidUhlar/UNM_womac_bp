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


        $tagIds = $request->input('tags');
        $oznam = Oznam::find($oznamId);
        $oznam->tag()->sync($tagIds);


        return redirect()->route('oznam.oznam');
    }
}
