<?php

namespace RiddleWebhook;

/**
 * RiddleGoogleSpreadsheet
 *
 * @author Reimar <reimar@riddle.com>
 */
class RiddleGoogleSpreadsheet
{

    /**
     * 
     * @param Google_Client $client
     * @param string $spreadsheetId
     * @param int $worksheatId
     */
    public function __construct($client, $spreadsheetId, $worksheatId = 0)
    {
        $this->service = new Google_Service_Sheets($client);
        $this->spreadsheetId = $spreadsheetId;
        $this->worksheatId = $worksheatId;
    }

    /**
     * 
     * @param RiddleResponse $riddleResponse
     */
    public function insertRiddleResponse($riddleResponse)
    {
        $requests = [
            $this->_createColumnHeadsRequest($riddleResponse),
            $this->_createInsertDataRequest($riddleResponse)
        ];

        $this->_batchUpdate($requests);
    }

    /**
     * 
     * @param array $requests
     * @return \RiddleGoogleSpreadsheet
     */
    protected function _batchUpdate($requests)
    {
        $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
            'requests' => $requests
        ));

        try {
            $this->service->spreadsheets->batchUpdate($this->spreadsheetId, $batchUpdateRequest);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        return $this;
    }

    /**
     * 
     * @param RiddleResponse $riddleResponse
     * @return \Google_Service_Sheets_Request
     */
    private function _createColumnHeadsRequest($riddleResponse)
    {
        $cells = [];
        $answerNum = 1;

        foreach ($riddleResponse->getLeadFields() as $_field) {
            $cells[] = strtolower($_field);
        }

        foreach ($riddleResponse->getAnswers() as $_answer) {
            foreach ($_answer as $_field => $_data) {
                $cells[] = strtolower($_field . '-' . $answerNum);
            }
            $answerNum++;
        }

        if ($riddleResponse->getResult()) {
            $cells[] = 'result';
        }

        $cells[] = 'created-at';

        $gridRange = new Google_Service_Sheets_GridRange();
        $gridRange->setSheetId($this->worksheatId);
        $gridRange->setStartRowIndex(0);
        $gridRange->setEndRowIndex(1);
        $gridRange->setStartColumnIndex(0);
        $gridRange->setEndColumnIndex(count($cells));

        return $this->_createRequestUpdate($cells, $gridRange);
    }

    /**
     * 
     * @param RiddleResponse $riddleResponse
     * @return \Google_Service_Sheets_Request
     */
    private function _createInsertDataRequest($riddleResponse)
    {
        foreach ($this->getInsertData($riddleResponse) as $_value) {
            $cellData = new Google_Service_Sheets_CellData();
            $value = new Google_Service_Sheets_ExtendedValue();
            $value->setStringValue((string) $_value);
            $cellData->setUserEnteredValue($value);
            $values[] = $cellData;
        }

        return $this->_createRequestAppend($values);
    }

    /**
     * 
     * @param array $values
     * @param Google_Service_Sheets_GridRange $gridRange
     * @return \Google_Service_Sheets_Request
     */
    private function _createRequestUpdate($values, $gridRange)
    {
        $rowDataValues = [];

        foreach ($values as $_value) {
            $cellData = new Google_Service_Sheets_CellData();
            $value = new Google_Service_Sheets_ExtendedValue();
            $value->setStringValue((string) $_value);
            $cellData->setUserEnteredValue($value);
            $rowDataValues[] = $cellData;
        }

        $rowData = new Google_Service_Sheets_RowData();
        $rowData->setValues($rowDataValues);
        $rows = [$rowData];

        $updateCellsRequest = new Google_Service_Sheets_UpdateCellsRequest();
        $updateCellsRequest->setRange($gridRange);
        $updateCellsRequest->setRows($rows);
        $updateCellsRequest->setFields('userEnteredValue');

        $request = new Google_Service_Sheets_Request();
        $request->setUpdateCells($updateCellsRequest);

        return $request;
    }

    /**
     * 
     * @param array $values
     * @return \Google_Service_Sheets_Request
     */
    private function _createRequestAppend($values)
    {
        $rowData = new Google_Service_Sheets_RowData();
        $rowData->setValues($values);

        $appendRequest = new Google_Service_Sheets_AppendCellsRequest();
        $appendRequest->setSheetId($this->worksheatId);
        $appendRequest->setRows($rowData);
        $appendRequest->setFields('userEnteredValue');

        $request = new Google_Service_Sheets_Request();
        $request->setAppendCells($appendRequest);

        return $request;
    }

    /**
     * 
     * @param RiddleResponse $riddleResponse
     * @return array
     */
    public function getInsertData($riddleResponse)
    {
        $answerNum = 1;
        $data = [];

        foreach (get_object_vars($riddleResponse->getLead()) as $_field => $_value) {
            $data[strtolower($_field)] = $_value;
        }

        foreach ($riddleResponse->getAnswers() as $_answer) {
            foreach (get_object_vars($_answer) as $_field => $_value) {
                $data[strtolower($_field) . '-' . $answerNum] = $_value;
            }
            $answerNum++;
        }

        $data['result'] = $riddleResponse->getResult();
        $data['created-at'] = $riddleResponse->getCreatedAt();

        return array_change_key_case($data, CASE_LOWER);
    }

}
