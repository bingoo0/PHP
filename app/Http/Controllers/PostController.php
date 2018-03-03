<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use File;

class PostController extends Controller
{
    public function Create()
    {

    	return view('posts.form');
    }

    public function Store(Request $req)
    {
    	$this->validate($req,[
    		'title' => 'required|max:255',
    		'text' => 'required',
    		'photo' => 'required|max:1024',
    	]);

    	$model = $req->all();

    	$file = $model['photo'];

    	if($file)
    	{
    		$fileName = str_random(5).$file->getClientOriginalName();
    		$file->move('images', $fileName);
    		$model['imagePath'] = 'images'.DIRECTORY_SEPARATOR.$fileName;
    	}
    	

    	if(Post::create($model))
    	{
    		return back()->with('message','success');
    	}

    	return back()->with('message','error');
	}

	public function Edit($id)
    {
        $p = Post::find($id);

        if(!$p)
        {
            return redirect(404);
        }

        return view('posts.form',['post' => $p]);
    }
	
	public function Update($id, Request $req)
    {
        $this->validate($req,[
            'title' => 'required|max:255',
            'text' => 'required',
            'photo' => 'max:1024',
        ]);

        $p = Post::find($id);

        if(!$p)
        {
            return redirect(404);
        }

        $p->title = $req->title;
        $p->text = $req->text;

        $photo = $req->file('photo');

        if($photo)
        {
            File::delete($p->imagePath);
            $fileName = str_random(5).$photo->getClientOriginalName();
            $photo->move('images', $fileName);
            $p->imagePath = 'images'.DIRECTORY_SEPARATOR.$fileName;
        }

        if($p->save())
        {
            return back()->with('success','OK');
        }

        return back()->with('error','error');
	}
	
	public function Delete($id)
    {
        $p = Post::find($id);

        if(!$p)
        {
            return redirect(404);
        }

        if($p->imagePath)
        {
            File::delete($p->imagePath);
        }

        if($p->delete())
        {
            return back()->with('success','OK');
        }

        return back()->with('error','error');
    }

    public function Index()
    {
    	$posts = Post::paginate(2);

    	return view('posts.index', ['posts' => $posts]);
    }
}
