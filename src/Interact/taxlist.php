<?php


    namespace Milestone\SS\Interact;

    use Illuminate\Support\Arr;
    use Milestone\Interact\Table;
    use Milestone\SS\Model\Product;

    class taxlist implements Table
    {
        private $cache = [
            'product' => null,
        ];
        public function getModel()
        {
            return Product::class;
        }

        public function getImportAttributes()
        {
            return ['taxfactor','taxfactor02'/*,'subtaxfactor02','subtaxfactor'*/];
        }

        public function getImportMappings()
        {
            return [
                'taxfactor' => 'TAXFACTOR',
//                'subtaxfactor' => 'SUBTAXFACTOR',
                'taxfactor02' => 'TAXFACTOR02',
//                'subtaxfactor02' => 'SUBTAXFACTOR02'
            ];
        }

        public function getPrimaryIdFromImportRecord($data)
        {
            return $this->getProductId($data);
        }

        public function getExportAttributes()
        {
            return [];
        }

        public function getExportMappings()
        {
            return [];
        }

        public function getProductId($data){
            if($this->cache['product'] === null) $this->cache['product'] = Product::pluck('id','code')->toArray();
            return Arr::get($this->cache['product'],$data['CODE'],null);
        }

        public function isValidImportRecord($record){
            return ($record['CODE'] && $this->getProductId($record));
        }
    }