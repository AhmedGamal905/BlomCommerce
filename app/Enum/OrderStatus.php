<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
