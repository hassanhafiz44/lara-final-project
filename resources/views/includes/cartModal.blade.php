<div class="modal fade" id="cart-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Cart</h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <form id="cart-form" method="POST">
                        @csrf<br>
                        <input type="hidden" value="{{ route('pages.invoices.store') }}" name="action_url" />
                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" id="submit-cart-form" class="btn btn-success">{{ __('labels.confirm') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('labels.close') }}</button>
            </div>

        </div>
    </div>
</div>