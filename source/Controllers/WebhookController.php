<?php

namespace Source\Controllers;

use Source\Core\Request;
use Source\Models\WebhookReceived;

class WebhookController
{
    private WebhookReceived $webhookReceived;

    public function __construct()
    {
        $this->webhookReceived = new WebhookReceived();
    }

    public function save(): void
    {
        $request = Request::decode(file_get_contents('php://input'));

        if (!$request || count($request) < 1) {
            echo response([
                'message' => 'No data received'
            ], 400)->json();
            return;
        }

        if (!$this->validate($request)) {
            echo response([
                'error' => 'Invalid data'
            ], 400)->json();
            return;
        }

        $exists = $this->webhookReceived
            ->find('order_id = :orderId', 'orderId=' . $request['order']['id'])
            ->fetch();

        if ($exists && $exists->id) {
            echo response([
                'message' => "Webhook $exists->id already received"
            ], 400)->json();
            return;
        }

        $createdId = $this->webhookReceived->create([
            'construp_user_id' => $request['construpUserId'],
            'tag' => $_SERVER['HTTP_X_WEBHOOK_TAG'],
            'order_id' => $request['order']['id'],
            'sent_from_url' => $_SERVER['REMOTE_ADDR'] ?? '',
        ]);

        if (!$createdId) {
            echo response([
                'data_received' => $request,
                'error' => 'Error saving data',
                'exception' => $this->webhookReceived->fail()
            ], 500)->json();
            return;
        }

        echo response([
            'message' => "Webhook received successfully",
            'id' => $createdId
        ])->json();
    }

    public function list(array $params): void
    {
        $webhooks = $this->webhookReceived->find()->fetch(true) ?? [];

        if (empty($webhooks)) {
            echo response("No webhooks found")->json();
            return;
        }

        $return = <<<HTML
            <ul style="font-family: Segoe UI, sans-serif; border: 1px solid #ccc; padding: 10px 40px; border-radius: 8px">
        HTML;

        foreach ($webhooks as $webhook) {
            $formattedDate = (new \DateTimeImmutable($webhook->created_at))->format('d/m/Y H:i:s');

            $return .= <<<HTML
                <li>
                    <span>Order Id: <b>$webhook->order_id</b> | Construp User Id: $webhook->construp_user_id | Tag: {$webhook->tag} | Recebido em: [{$formattedDate}]</span>
                </li>
            HTML;
        }

        $return .= <<<HTML
            </ul>
        HTML;

        echo response($return)->html();
    }

    private function validate(array $data): bool
    {
        if (
            !array_key_exists('construpUserId', $data)
            || !filter_var($data['construpUserId'], FILTER_SANITIZE_NUMBER_INT)
        ) {
            return false;
        }

        if (
            !array_key_exists('order', $data)
            || !array_key_exists('id', $data['order'])
            || !filter_var($data['order']['id'], FILTER_SANITIZE_NUMBER_INT)
        ) {
            return false;
        }

        return true;
    }
}
