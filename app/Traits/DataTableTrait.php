<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

trait DataTableTrait
{
    protected function getTrashDataTable($query, $modelName, $routePrefix = 'backoffice')
    {
        return DataTables::of($query)
            ->addColumn('id', function ($model) {
                return $model->id;
            })
            ->addColumn('name', function ($model) {
                return $model->name ?? 'N/A';
            })
            ->addColumn('slug', function ($model) {
                return $model->slug ?? 'N/A';
            })
            ->addColumn('deleted_at', function ($model) {
                return $model->deleted_at ? $model->deleted_at->format('Y-m-d H:i:s') : '';
            })
            ->addColumn('actions', function ($model) use ($routePrefix, $modelName) {
                $restoreUrl = url("{$routePrefix}/{$modelName}/{$model->id}/restore");
                return '<form method="POST" action="' . e($restoreUrl) . '" onsubmit="return confirm(\'Khôi phục ' . $modelName . ' này?\')">' .
                    csrf_field() .
                    '<button type="submit" class="btn btn-success btn-sm"><i class="la la-undo"></i> Khôi phục</button>' .
                    '</form>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}