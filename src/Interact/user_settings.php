<?php

    namespace Milestone\SS\Interact;

    use Milestone\Interact\Table;

    class user_settings implements Table
    {
        public function getModel()
        {
            return \Milestone\SS\Model\UserSetting::class;
        }

        public function getImportAttributes()
        {
            return [];
        }

        public function getImportMappings()
        {
            return [];
        }

        public function getPrimaryIdFromImportRecord($data)
        {
        }

        public function getExportMappings()
        {
            return [];
        }

        public function getExportAttributes()
        {
            return ['id','user','setting','value','status'];
        }

        public function preExportGet($query){
            return (request()->_user) ? $query->where('user',request()->_user) : $query;
        }
        public function preExportUpdate($query){
            return (request()->_user) ? $query->where('user',request()->_user) : $query;
        }
    }