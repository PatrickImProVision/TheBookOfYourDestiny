<?php

namespace App\Controllers\Store;

use App\Controllers\BaseController;

class View extends BaseController
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
        return view('store/view', $data);
    }
}
