<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    
public function upload(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt|max:10240', 
    ]);
    
    $file = $request->file('csv_file');
    $path = $file->getRealPath();
    
    $csv = Reader::createFromPath($path, 'r');
    $csv->setHeaderOffset(0);
    
    $imported = 0;
    foreach ((new Statement())->process($csv) as $row) {
        Paper::create([
            'title' => $row['title'],
            'authors' => $row['authors'] ?? null,
            'venue' => $row['venue'] ?? null,
            'publication_year' => $row['year'] ?? null,
            'doi' => $row['doi'] ?? null,
            'abstract' => $row['abstract'] ?? null,
        ]);
        $imported++;
    }
    
    return back()->with('success', "Berhasil import {$imported} papers!");
}
}
