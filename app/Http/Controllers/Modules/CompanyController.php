<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Post;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use TraitApiResource;
    public function index()
    {
        $company = CompanyResource::collection(Company::get());
        return $this->ApiResource($company,'Retrived Done',200);
    }
    public function show($id)
    {
        try {
            $company = Company::find($id);
            if ($company) {
                $company = new CompanyResource(Company::find($id));
                return $this->ApiResource($company, 'ok', 200);
            }
        }
        catch (\Exception $e){
            return $this->ApiResource(null,'Company Not Found',404);
        }
    }

    public function store(CompanyRequest $request)
    {
        try{
        $company = Company::create($request->all());
        if($company)
            return $this->ApiResource($company,'ok',200);
        } catch (\Exception $e){
            return $this->ApiResource(null,'Company Not Found',404);
            }
    }
    public function update(CompanyRequest $request,$id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->update($request->all());
            return $this->ApiResource($company,'ok',200);
        }catch (\Exception $e){
            return $this->ApiResource(null,'Company Not Found',404);
        }
    }
    public function destroy($id)
    {
        try {
            $company = Company::findOrFail($id);
            $company->delete();
            return $this->ApiResource(null,'ok',200);
        }catch (\Exception $e){
            return $this->ApiResource(null,'Company Not Found',404);
        }
    }


}
