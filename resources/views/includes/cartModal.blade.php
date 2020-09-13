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

                        <input type="hidden" value="" name="action-url" />
                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>