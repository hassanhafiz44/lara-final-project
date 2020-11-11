<div class="modal fade" id="invoice-statuses-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Change Invoice Status</h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="form-group">
                        <label for="payment-status">Payment Status</label>
                        <select ng-model="payment_status" class="form-control form-control-sm" id="payment-status" ng-change="onPaymentStatusChange()">
                            <option ng-if="invoice_status !== 'canceled'" value="paid">Paid</option>
                            <option ng-if="invoice_status !== 'delivered'" value="due">Due</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="invoice-status">Invoice Status</label>
                        <select ng-model="invoice_status" class="form-control form-control-sm" id="invoice-status" ng-change="onInvoiceStatusChange()">
                            <option value="ready">Ready</option>
                            <option value="processing">Processing</option>
                            <option ng-if="payment_status === 'paid'" value="delivered">Delivered</option>
                            <option ng-if="payment_status !== 'paid'" value="canceled">Canceled</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>