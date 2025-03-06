<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();

        return view('user.edit', compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        if (auth()->id() !== (int) $id) {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255'
        ]);

        $user = auth()->user();
        $user->update($validatedData); 
        
        return redirect()->route('user.edit', ['id' => $id])->with('success', 'Profile updated successfully!');
    }
}
