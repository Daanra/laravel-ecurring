<?php

namespace Daanra\Ecurring\Repositories;

use Daanra\Ecurring\Models\Invoice;

/**
 * Class InvoiceRepository
 * @method static Invoice|null find($id)
 */
class InvoiceRepository extends BaseRepository
{
    protected static $model = Invoice::class;
}
