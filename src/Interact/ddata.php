<?php

    namespace Milestone\SS\Interact;

    use Illuminate\Support\Arr;
    use Milestone\Interact\Table;
    use Milestone\SS\Model\Receipt;

    class ddata implements Table
    {
        public function getModel()
        {
            return \Milestone\SS\Model\DData::class;
        }

        public function getImportAttributes()
        {
            return ['COCODE', 'BRCODE', 'FYCODE', 'FNCODE', 'DOCNO', 'SRNO', 'SLNO', 'DOCDATE', 'CO', 'BR', 'ACCCODE', 'REFNO', 'REFDATE', 'AMT', 'SIGN', 'NARRATION', 'NARRATION2', 'REFCOCODE', 'REFBRCODE', 'REFFYCODE', 'REFFNCODE', 'REFDOCNO', 'REFSRNO', 'TYPE', 'APPROVAL_STATUS', 'APPROVAL_MODE', 'APPROVAL_TYPE', 'CANCEL', 'VERSION'];
        }

        public function getImportMappings()
        {
            return [];
        }

        public function getPrimaryIdFromImportRecord($data)
        {
            $pks = ['COCODE', 'BRCODE', 'FYCODE', 'FNCODE', 'DOCNO', 'SRNO'];
            $priData = Arr::only($data,$pks);
            $ddata = \Milestone\SS\Model\DData::where($priData)->first();
            return $ddata ? $ddata->id : null;
        }

        public function getExportMappings()
        {
            // TODO: Implement getExportMappings() method.
        }

        public function getExportAttributes()
        {
            // TODO: Implement getExportAttributes() method.
        }

        public function recordImported($record){
            list('DOCNO' => $docno, 'FYCODE' => $fycode, 'FNCODE' => $fncode, 'NARRATION2' => $bank) = $record;
            $pri = compact($docno,$fycode,$fncode); $data = compact($bank);
            Receipt::where($pri)->update($data);
        }
    }