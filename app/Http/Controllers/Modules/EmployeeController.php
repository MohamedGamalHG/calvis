<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use TraitApiResource;
    public function index()
    {
        $Employee = EmployeeResource::collection(Employee::get());
        return $this->ApiResource($Employee,'Retrived Done',200);
    }
    public function show($id)
    {
        try {
            $Employee = Employee::find($id);
            if ($Employee) {
                $Employee = new EmployeeResource(Employee::find($id));
                return $this->ApiResource($Employee, 'ok', 200);
            }
        }
        catch (\Exception $e){
            return $this->ApiResource(null,'Employee Not Found',404);
        }
    }

    public function store(EmployeeRequest $request)
    {
        try{
            $Employee = Employee::create($request->all());
            if($Employee)
                return $this->ApiResource($Employee,'ok',200);
        } catch (\Exception $e){
            return $this->ApiResource(null,'Employee Not Found',404);
        }
    }
    public function update(EmployeeRequest $request,$id)
    {
        try {
            $Employee = Employee::findOrFail($id);
            $Employee->update($request->all());
            return $this->ApiResource($Employee,'ok',200);
        }catch (\Exception $e){
            return $this->ApiResource(null,'Employee Not Found',404);
        }
    }
    public function destroy($id)
    {
        try {
            $Employee = Employee::findOrFail($id);
            $Employee->delete();
            return $this->ApiResource(null,'ok',200);
        }catch (\Exception $e){
            return $this->ApiResource(null,'Employee Not Found',404);
        }
    }
}
