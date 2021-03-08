<?php
namespace App\Traits;

use App\ApiStatus;

trait BooleanToggleTrait
{
    public function toggleBool($model, $column, $id)
    {
        $nameSpacedModel = '\\App\\' . $model;
        $record = $nameSpacedModel::find($id);
        $record->{$column} = ! $record->{$column};
        $record->save();
        $apiStatus = ApiStatus::where('id','=',1)->first();
        $apiStatus->status = 1;
        $apiStatus->save();
    }
}