<?php

    namespace Milestone\SS\Interact;

    use Illuminate\Support\Arr;
    use Milestone\Interact\Table;
    use Milestone\SS\Model\Product;
    use Milestone\SS\Model\SalesOrder;
    use Milestone\SS\Model\SalesOrderItem;

    class piidata implements Table
    {
        public $product_cache = null;
        private $so_ref = [];

        public function getModel()
        {
            return SalesOrderItem::class;
        }

        public function getImportAttributes()
        {
            return ['so','product','rate','quantity','tax','discount','total','_ref'];
        }

        public function getImportMappings()
        {
            return [
                'rate' => 'RATE',
                'quantity' => 'QTY',
                'tax' => 'TAX',
                'discount' => 'getDiscount',
                'total' => 'getTotal',
                'so' => 'getSO',
                'product' => 'getProductID',
                '_ref' => 'getRef'
            ];
        }

        public function getDiscount($record){
            return 0;
        }
        public function getTotal($record){
            return (floatval($record['QTY']) * floatval($record['RATE'])) + floatval($record['TAX']) - $this->getDiscount($record);
        }
        public function getSO($record){
            list('DOCNO' => $docno,'FYCODE' => $fycode, 'FNCODE' => $fncode) = $record;
            $so = SalesOrder::where(compact('fycode','fncode','docno'))->first();
            $id = $so ? $so->id : null;
            if($id) $this->so_ref[implode('-',[$fycode,$fncode,$docno])] = $so->_ref;
            return $id;
        }
        public function getRef($record){
            list('DOCNO' => $docno,'FYCODE' => $fycode, 'FNCODE' => $fncode) = $record;
            return $this->so_ref[implode('-',[$fycode,$fncode,$docno])];
        }

        public function getProductID($record){
            return Arr::get($this->product_cache,$record['ITEMCODE']);
        }

        public function getPrimaryIdFromImportRecord($data)
        {
            $so = $this->getSO($data); $product = $data['ITEMCODE'];
            $soi = SalesOrderItem::where(compact('so','product'))->first();
            return $soi ? $soi->id : null;
        }

        public function preImport(){
            $this->product_cache = Product::pluck('id','code')->toArray();
        }

        public function getExportMappings()
        {
            // TODO: Implement getExportMappings() method.
        }

        public function getExportAttributes()
        {
            // TODO: Implement getExportAttributes() method.
        }
    }