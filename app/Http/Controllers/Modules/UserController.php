<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Ramsey\Uuid\Generator\timestamp;

class UserController extends Controller
{
    use TraitApiResource;
    public function index()
    {
        $User = UserResource::collection(User::get());
        return $this->ApiResource($User,'Retrived Done',200);
    }
    public function show($id)
    {
        try {
            $User = User::find($id);
            if ($User) {
                $User = new UserResource(User::find($id));
                return $this->ApiResource($User, 'ok', 200);
            }
        }
        catch (\Exception $e){
            return $this->ApiResource(null,'User Not Found',404);
        }
    }

    public function store(UserRequest $request)
    {

        try{
            $User = new User();
            $User->username = $request->username;
            $User->email = $request->email;
            $User->phone = $request->phone;
            $User->password = Hash::make($request->password);
            $file_name = time().'_'.$request->profile_picture->getClientOriginalName();
            $filePath = $request->file('profile_picture')->storeAs('uploads', $file_name, 'public');
            $User->profile_picture = time().'_'.$request->profile_picture->getClientOriginalName();

            $User->save();

            if($User)
                return $this->ApiResource($User,'ok',200);
        } catch (\Exception $e){
            return $this->ApiResource(null,'User Not Found',404);
        }
    }
    public function update(Request $request,$id)
    {

        try {
            $User = User::findOrFail($id);
            $User->username = $request->username;
            $User->email = $request->email;
            $User->phone = $request->phone;
            $User->password = Hash::make($request->password);

            if($request->profile_picture) {
                $file_name = time() . '_' . $request->profile_picture->getClientOriginalName();
                $filePath = $request->file('profile_picture')->storeAs('uploads', $file_name, 'public');
                $User->profile_picture = time() . '_' . $request->profile_picture->getClientOriginalName();
                $User->save();
            }
            else{

                $User->profile_picture = User::select('profile_picture')->where('id',$id)->first()['profile_picture'];
                $User->save();


            }


            return $this->ApiResource($User,'ok',200);
        }catch (\Exception $e){
            return $this->ApiResource(null,'User Not Found',404);
        }
    }
    public function destroy($id)
    {
        try {
            $User = User::findOrFail($id);
            $User->delete();
            return $this->ApiResource(null,'ok',200);
        }catch (\Exception $e){
            return $this->ApiResource(null,'User Not Found',404);
        }
    }
    private function saveImage($photo,$product_id){
        if(!empty($photo)){
            foreach ($photo as $photos)
            {
                $photos->storeAs('photos/'.$product_id,$photos->getClientOriginalName(),'public');
                $photos->move(public_path('photos/'.$product_id),$photos->getClientOriginalName());

                $img = new Image();
                $img->name = $photos->getClientOriginalName();
                $img->product_id = $product_id;
                $img->save();
            }
        }

    }
}
