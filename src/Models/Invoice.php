<?php

namespace Daanra\Ecurring\Models;

/**
 * An Invoice entity in eCurring.
 */
class Invoice extends BaseModel
{
    public string $status;
    public string $reference;
    public string $amount_excl;
    public string $amount_incl;
    public array $tax_rates;
    public string $tax_amount;
    public ?string $invoice_date;
    public string $transaction_date;
    public string $hosted_invoice_url;
    public string $created_at;
    public string $updated_at;
}
