<div class="modal fade" id="invoice-statuses-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>@lang('labels.change_invoice_status')</h3>
            </div>

            <!-- Modal body -->
            <form ng-submit="onStatusChangeSubmit()">
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="payment-status">@lang('labels.payment_status')</label>
                            <select disabled ng-model="payment_status" class="form-control form-control-sm" id="payment-status" ng-change="onPaymentStatusChange()">
                                <option ng-if="invoice_status !== 'canceled'" value="paid">@lang('labels.paid')</option>
                                <option ng-if="invoice_status !== 'delivered'" value="due">@lang('labels.due')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="invoice-status">@lang('labels.invoice_status')</label>
                            <select ng-model="invoice_status_input" class="form-control form-control-sm" id="invoice-status" required>
                                <option value="">Select status</option>
                                <option value="canceled">@lang('labels.cancelled')</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">@lang('labels.submit')</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('labels.close')</button>
                </div>
            </form>
        </div>
    </div>
</div>