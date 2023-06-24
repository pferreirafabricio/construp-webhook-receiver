<?php

namespace Source\Models;

use Source\Core\Model;

class WebhookReceived extends Model
{
    public function __construct()
    {
        parent::__construct(
            "webhook_received",
            ["id"],
            ["tag", "construp_user_id", "tag", "order_id", "sent_from_url"]
        );
    }
}
