<?php

namespace Tjslash\CtoBackpackOperations\Http\Controllers\Operations;

use Illuminate\Support\Facades\Route;
use Backpack\Settings\app\Models\Setting;

trait SettingOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupSettingRoutes($segment, $routeName, $controller)
    {
        Route::get("{$segment}-setting", [
            'as'        => "{$routeName}.setting",
            'uses'      => "{$controller}@setting",
            'operation' => 'setting',
        ]);
        Route::put("{$segment}-setting", [
            'as'        => "{$routeName}.saveSetting",
            'uses'      => "{$controller}@saveSetting",
            'operation' => 'setting',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupSettingDefaults()
    {
        $this->crud->allowAccess('setting');

        $this->crud->operation('setting', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
            $this->crud->removeAllFields();
            $this->crud->addSaveActions([
                [
                    'name' => 'save_and_edit',
                    'button_text' => trans('backpack::crud.save_action_save_and_edit'),
                    'visible' => function($crud) {
                        return true;
                    },
                ],
                [
                    'name' => 'save_and_back',
                    'button_text' => trans('backpack::crud.save_action_save_and_back'),
                    'visible' => function($crud) {
                        return true;
                    },
                ],
            ]);
            $this->data['crud'] = $this->crud;
            $this->data['saveAction'] = $this->crud->getSaveAction();
            $this->crud->setTitle(
                trans('tjslash::cto-backpack-operations.settings'), 
                'setting'
            );
            $this->crud->setHeading(
                trans('tjslash::cto-backpack-operations.settings'), 
                'setting'
            );
            $this->crud->setSubheading(
                trans('tjslash::cto-backpack-operations.edit_setting'), 
                'setting'
            );
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton(
                'top', 
                'setting', 
                'view', 
                'tjslash.cto-backpack-operations::buttons.setting'
            );
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function setting()
    {
        $this->crud->hasAccessOrFail('setting');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? 'setting ' . $this->crud->entity_name;

        foreach ($this->crud->getFields() as $name => $field) {
            $this->crud->field($name)->value(
                Setting::get($name)
            );
        }
        return view("tjslash.cto-backpack-operations::operations.setting", $this->data);
    }

    /**
     * Save operation
     */
    public function saveSetting()
    {
        foreach ($this->crud->getFields() as $name => $field) {
            Setting::set($name, $this->crud->getRequest()->get($name));
        }

        \Alert::success(trans('tjslash::cto-backpack-operations.success'))->flash();

        if ($this->crud->getRequest()->get('save_action') == 'save_and_edit') {
            return back();
        }

        return \Redirect::to($this->crud->route);
    }
}
