<div class="modal fade" id="invoice-statuses-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>@lang('labels.change_invoice_status')</h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    @if (Auth::guard('web')->check())
                    <div class="form-group">
                        <label for="payment-status">@lang('labels.payment_status')</label>
                        <select ng-model="payment_status" class="form-control form-control-sm" id="payment-status" ng-change="onPaymentStatusChange()">
                            <option ng-if="invoice_status !== 'canceled'" value="paid">@lang('labels.paid')</option>
                            <option ng-if="invoice_status !== 'delivered'" value="due">@lang('labels.due')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="invoice-status">@lang('labels.invoice_status')</label>
                        <select ng-model="invoice_status" class="form-control form-control-sm" id="invoice-status" ng-change="onInvoiceStatusChange()">
                            <option value="ready">@lang('labels.ready')</option>
                            <option value="processing">@lang('labels.processing')</option>
                            <option ng-if="payment_status === 'paid'" value="delivered">@lang('labels.delivered')</option>
                            <option ng-if="payment_status !== 'paid'" value="canceled">@lang('labels.cancelled')</option>
                        </select>
                    </div>
                    @endif
                    @if (Auth::guard('customers')->check())
                    <div class="form-group">
                        <label for="payment-status">@lang('labels.payment_status')</label>
                        <select disabled ng-model="payment_status" class="form-control form-control-sm" id="payment-status" ng-change="onPaymentStatusChange()">
                            <option ng-if="invoice_status !== 'canceled'" value="paid">@lang('labels.paid')</option>
                            <option ng-if="invoice_status !== 'delivered'" value="due">@lang('labels.due')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="invoice-status">@lang('labels.invoice_status')</label>
                        <select ng-model="invoice_status" class="form-control form-control-sm" id="invoice-status" ng-change="onInvoiceStatusChange()">
                            <option value="ready">@lang('labels.ready')</option>
                            <option value="processing">@lang('labels.processing')</option>
                            <option ng-if="payment_status === 'paid'" value="delivered">@lang('labels.delivered')</option>
                            <option ng-if="payment_status !== 'paid'" value="canceled">@lang('labels.cancelled')</option>
                        </select>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('labels.close')</button>
            </div>

        </div>
    </div>
</div>