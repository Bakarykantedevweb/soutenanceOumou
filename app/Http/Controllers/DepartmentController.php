<?php

namespace App\Http\Controllers;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = [
            'Direction générale',
            'Ressources humaines',
            'Finance',
            'Commercial',
            'Marketing',
            'Digital',
            'IT / Systèmes',
            'Juridique',
            'Qualité',
            'Logistique',
            'Service client',
            'Approvisionnement',
            'Sécurité',
        ];

        return view('admin.departments.index', compact('departments'));
    }
}
