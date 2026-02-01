<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use App\Models\Company;

// class CompanyController extends Controller
// {
//    public function index()
//    {
//        // Просто 10 последних компаний
//        $companies = Company::latest()->take(10)->get();
//
//        return view('demo.companies.index', compact('companies'));
//    }
//
//    public function show(Company $company)
//    {
//        // Без сложных отношений
//        return view('demo.companies.show', compact('company'));
//    }
// }

class CompanyController extends BaseDemoController
{
    protected $model = Company::class;

    protected $viewPath = 'companies';

    protected $entityName = 'company';

    protected function getRelations()
    {
        return ['contacts', 'deals']; // Базовые отношения для показа
    }
}
