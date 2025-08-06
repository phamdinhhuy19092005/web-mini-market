<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all();
    public function model();
    public function create();
    public function findOrFail($id);
    public function find($id);
    public function delete($id);
    public function update($id, array $attributes);
    
}
