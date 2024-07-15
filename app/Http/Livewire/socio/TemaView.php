<?php

namespace App\Http\Livewire\Socio;

use App\Models\Like;
use App\Models\Post;
use App\Models\Tema;
use Livewire\Component;

class TemaView extends Component
{   public $tema, $respuestatema, $respuestapost;
    public function mount($tema_id,$replytema_id,$replypost_id){
        $this->tema=Tema::find($tema_id);
        $this->respuestatema=Tema::find($replytema_id);
        $this->respuestapost=Post::find($replypost_id);

    }
    public function render()
    {    $posts=Post::where('tema_id',$this->tema->id)->paginate(25);
        return view('livewire.socio.tema-view',compact('posts'));
    }
    public function like(Post $post){
        $like=Like::create(['user_id'=>auth()->user()->id,
                            'likeable_type'=>'App\Models\Post',
                            'likeable_id'=>$post->id,
                            'type'=>'like']);
    }
    public function unlike(Post $post){
        $like=Like::create(['user_id'=>auth()->user()->id,
                            'likeable_type'=>'App\Models\Post',
                            'likeable_id'=>$post->id,
                            'type'=>'unlike']);
    }
    public function likeupdate(Like $like){
        if ($like->type=='like') {
            $like->update(['type'=>'unlike']);
        } else {
            $like->update(['type'=>'like']);
        }

        if ($like->likeable_type=='App\Models\Tema') {
            $this->tema=Tema::find($like->likeable_id);
            $this->render();
            //return redirect()->route('temas.show',$this->tema);
        } else {
            $this->tema=Tema::find($this->tema->id);
           // return redirect()->route('temas.show',$this->tema);
            $this->render();
        }
        
           

       
    }

    public function temalike(Tema $tema){
        $like=Like::create(['user_id'=>auth()->user()->id,
                            'likeable_type'=>'App\Models\Tema',
                            'likeable_id'=>$tema->id,
                            'type'=>'like']);
        $this->tema=Tema::find($tema->id);
    }
    public function temaunlike(Tema $tema){
        $like=Like::create(['user_id'=>auth()->user()->id,
                            'likeable_type'=>'App\Models\Tema',
                            'likeable_id'=>$tema->id,
                            'type'=>'unlike']);
        $this->tema=Tema::find($tema->id);
    }

    public function responder_tema(Tema $tema){
        $this->respuestatema=$tema;
        $this->tema=Tema::find($tema->id);
        return redirect(route('tema.reply',$this->tema).'/#responder');
    }

    public function responder_post(Post $post){
        $this->respuestapost=$post;
        $this->tema=Tema::find($this->tema->id);
        return redirect(route('post.reply',$post).'/#responder');
    }
}
