<?php

namespace App\Http\Controllers\User\Worker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Worker;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Worker $worker)  // Request $request
    {
        $this->authorize('delete', $worker);

        $delete = $request->input('delete');

        if ($delete == 'Yes') {
            // return 'delete';

            // remove a many-to-many relationship record
            // $d = $worker->employers()->detach();

            // remove user
            // $u = $worker->user->delete();

            // remove worker
            // $w = $worker->delete();
            $w = $worker->delete_();

            // var_dump($d); var_dump($u);
            dd($w);
            /*
            $imgStorage->setDirectoryName(config('settings.blog_img_dir'));
            $d = $imgStorage->deleteDirectory($post->id);  // true|false
            
            $post->delete_();  // true|false
            
            return redirect()
                ->route('categories.show', $category->id)
                ->with('success', 'Usunięto');
            */
        }

        if ($delete == 'No') {
            return redirect()->route('workers.show', $worker->id);
        }

        return view(
            'user.worker.destroy',
            ['worker' => $worker]
        );

        // return $worker;
    }
}
