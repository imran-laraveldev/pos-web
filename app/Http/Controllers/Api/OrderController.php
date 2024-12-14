<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Modules\Reports\Entities\Order;

class OrderController extends Controller
{
    public function __construct(Order $model, OrderRepository $repository) {
        parent::__construct();
        $this->model = $model;
        $this->repository = $repository;
    }

    public function index(Request $request) {
        return $this->repository->getOrders([
            'relation_id' => $request->input('relation_id'),
        ]);
    }

    public function store(Request $request) {
        $this->request = $request;
        $model = $this->repository->save($this->getFormData());
        if (!$model) {
            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Note has not been Created.'
            ], self::STATUS_BAD_REQUEST);
        }
        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Note Created Successfully!'
        ], self::STATUS_CREATED);
    }

    public function update(Request $request, $id) {
        $this->request = $request;
        $model = $this->repository->update($id, $this->getFormData());
        if (!$model) {
            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Note has not been Updated.'
            ], self::STATUS_BAD_REQUEST);
        }
        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Note Updated Successfully!',
            'data'=>new NoteResource($model)
        ], self::STATUS_OK);
    }

    public function destroy(Request $request, $id) {
        $this->request = $request;
        if (!$this->repository->forceDelete($id)) {
            return $this->httpResponse->setResponse([
                'success' => false,
                'errors' => 'Note has not been Deleted.'
            ], self::STATUS_BAD_REQUEST);
        }
        return $this->httpResponse->setResponse([
            'success' => true,
            'message' => 'Note Deleted Successfully!'
        ], self::STATUS_CREATED);
    }

    private function getFormData() {
        return [
            'module_id' => $this->request->input('module_id'),
            'relation_id' => $this->request->input('relation_id'),
            'subject' => $this->request->input('subject'),
            'description' => $this->request->input('description'),
            'is_reminder_enabled' => $this->request->input('is_reminder_enabled'),
            'reminder_date' => $this->request->input('reminder_date'),
            'reminder_at' => $this->request->input('reminder_at'),
            'is_notification_enabled' => $this->request->input('is_notification_enabled'),
            'is_comment_allowed' => $this->request->input('is_comment_allowed'),
            'is_flag_enabled' => $this->request->input('is_flag_enabled'),
        ];
    }
}
