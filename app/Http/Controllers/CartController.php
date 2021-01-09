<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Cart;
use Session;
// use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(!Session::has('cart'))
       {
           return view('cart.index');
       }
       $oldCart=Session::get('cart');
       $cart=new Cart($oldCart);
       return view('cart.index',)->with('post',$cart->items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }
    

    public function add(Request $request,$id)
    {
        $post=Post::find($id);
        $oldCart=Session::has('cart') ? Session::get('cart'): null;
        $cart= new Cart($oldCart);
        $cart->add($post,$post->id);
        $request->session()->put('cart',$cart);
        // dd($request->session()->get('cart'));
        return redirect('/posts');
        // dd($id);
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
