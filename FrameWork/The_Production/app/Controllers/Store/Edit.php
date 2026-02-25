<?php

namespace App\Controllers\Store;

use App\Controllers\BaseController;

class Edit extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([
            'CaseID',
            'BookID',
            'PreFaceID',
            'PageID',
            'FlagStoneID',
            'FullStoryID',
            'KnowledgeID',
            'BibleLegendID',
            'LeaderShipID',
        ]);
        return view('store/edit', $data);
    }
}
